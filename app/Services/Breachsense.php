<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use RuntimeException;

class Breachsense
{
    public function exposureCount(string $email): int
    {
        if (! config('services.breachsense.enabled') || blank(config('services.breachsense.key'))) {
            throw new RuntimeException('Breach lookup is not configured.');
        }

        $allowed = Cache::lock('breachsense-budget', 10)->block(2, function (): bool {
            $key = 'breachsense-queries:'.now()->format('Y-m');
            $limit = max(0, (int) config('services.breachsense.monthly_query_limit'));
            if ($limit === 0 || RateLimiter::tooManyAttempts($key, $limit)) {
                return false;
            }
            RateLimiter::hit($key, (int) now()->diffInSeconds(now()->addMonthNoOverflow()->startOfMonth()) + 60);

            return true;
        });

        if (! $allowed) {
            throw new RuntimeException('Breach lookup monthly budget exhausted.');
        }

        try {
            $response = Http::withHeaders(['lic' => config('services.breachsense.key')])
                ->acceptJson()->connectTimeout(5)->timeout(20)->withoutRedirecting()
                ->get('https://api.breachsense.com/creds', ['s' => $email, 'count' => 1]);
        } catch (ConnectionException) {
            throw new RuntimeException('Breach lookup connection unavailable.');
        }

        if ($response->status() !== 200) {
            throw new RuntimeException('Breach lookup unavailable (HTTP '.$response->status().').');
        }

        $payload = $response->json();
        if (is_array($payload)) {
            if (isset($payload['error'])) {
                throw new RuntimeException('Breach lookup returned an error.');
            }
            $count = $payload['cnt'] ?? (count($payload) === 1 ? ($payload[0]['cnt'] ?? null) : null);
        } else {
            $count = $payload;
        }

        if ((! is_int($count) && ! (is_string($count) && ctype_digit($count)))
            || filter_var($count, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false) {
            throw new RuntimeException('Breach lookup returned an invalid count.');
        }

        return (int) $count;
    }
}
