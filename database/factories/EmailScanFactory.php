<?php

namespace Database\Factories;

use App\Models\EmailScan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<EmailScan> */
class EmailScanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'email' => fn (array $attributes): string => User::findOrFail($attributes['user_id'])->email,
            'status' => EmailScan::Queued,
        ];
    }

    public function completed(): static
    {
        return $this->state(fn (): array => [
            'status' => EmailScan::Completed, 'exposure_count' => 1, 'checked_at' => now(),
        ]);
    }
}
