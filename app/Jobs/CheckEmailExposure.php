<?php

namespace App\Jobs;

use App\Models\EmailScan;
use App\Services\Breachsense;
use DateTimeInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Throwable;

class CheckEmailExposure implements ShouldQueue
{
    use Queueable;

    public int $timeout = 30;

    public int $maxExceptions = 3;

    public array $backoff = [30, 120, 300];

    public DateTimeInterface $deadline;

    public function __construct(public int $scanId)
    {
        $this->deadline = now()->addHour();
    }

    public function retryUntil(): DateTimeInterface
    {
        return $this->deadline;
    }

    public function middleware(): array
    {
        return [
            (new WithoutOverlapping((string) $this->scanId))->releaseAfter(5)->expireAfter(60),
            (new RateLimited('breachsense'))->releaseAfter(2),
        ];
    }

    public function handle(Breachsense $breachsense): void
    {
        $scan = EmailScan::with('user')->find($this->scanId);
        if (! $scan || $scan->status !== EmailScan::Queued) {
            return;
        }
        if (! $scan->user?->hasVerifiedEmail() || $scan->email !== $scan->user->email) {
            $this->failed(null);

            return;
        }

        $count = $breachsense->exposureCount($scan->email);
        $scan->forceFill([
            'status' => EmailScan::Completed, 'exposure_count' => $count, 'checked_at' => now(),
        ])->save();
    }

    public function failed(?Throwable $exception): void
    {
        EmailScan::whereKey($this->scanId)->where('status', EmailScan::Queued)->update([
            'status' => EmailScan::Failed, 'exposure_count' => null, 'checked_at' => null,
        ]);
    }
}
