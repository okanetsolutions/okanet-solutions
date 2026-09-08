<?php

namespace App\Services;

use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Sleep;
use RuntimeException;

class Breachsense
{
    private const EmailEndpoints = ['creds', 'stealer', 'combo'];

    public function exposureCount(string $email): int
    {
        if (! config('services.breachsense.enabled') || blank(config('services.breachsense.key'))) {
            throw new RuntimeException('Breach lookup is not configured.');
        }

        $endpoints = config('services.breachsense.endpoints');
        if (! is_array($endpoints) || $endpoints === []) {
            throw new RuntimeException('Breach lookup has no configured endpoints.');
        }
        foreach ($endpoints as $endpoint) {
            if (! is_string($endpoint) || ! in_array($endpoint, self::EmailEndpoints, true)) {
                throw new RuntimeException('Breach lookup contains an unsupported email endpoint.');
            }
        }

        return array_sum(array_map(
            fn (string $endpoint): int => $this->endpointExposureCount($endpoint, $email),
            array_values(array_unique($endpoints)),
        ));
    }

    private function endpointExposureCount(string $endpoint, string $email): int
    {
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
            $response = $this->request($endpoint, $email);
        } catch (ConnectionException) {
            throw new RuntimeException('Breach lookup connection unavailable.');
        } catch (LockTimeoutException) {
            throw new RuntimeException('Breach lookup request throttling unavailable.');
        }

        if ($response->status() !== 200) {
            throw new RuntimeException('Breach lookup endpoint '.$endpoint.' unavailable (HTTP '.$response->status().').');
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

    private function request(string $endpoint, string $email): Response
    {
        return Cache::lock('breachsense-request', 30)->block(5, function () use ($endpoint, $email): Response {
            if (RateLimiter::tooManyAttempts('breachsense-outbound', 1)) {
                Sleep::for(max(1, RateLimiter::availableIn('breachsense-outbound')))->seconds();
            }
            RateLimiter::hit('breachsense-outbound', 1);

            return Http::withHeaders(['lic' => config('services.breachsense.key')])
                ->acceptJson()->connectTimeout(5)->timeout(20)->withoutRedirecting()
                ->get('https://api.breachsense.com/'.$endpoint, ['s' => $email, 'count' => 1]);
        });
    }
}
