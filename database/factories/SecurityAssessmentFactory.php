<?php

namespace Database\Factories;

use App\Models\SecurityAssessment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<SecurityAssessment> */
class SecurityAssessmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), 'domain' => fake()->unique()->domainName(),
            'dns_token' => Str::random(64), 'dns_expires_at' => now()->addDays(7),
            'status' => SecurityAssessment::PendingVerification,
        ];
    }

    public function authorized(): static
    {
        return $this->state(fn (): array => [
            'dns_verified_at' => now(), 'authorized_at' => now(), 'due_at' => now()->addHours(48),
            'authorized_by' => 'Authorized representative', 'authorization_email' => 'security@company.com',
            'authorization_ip' => '127.0.0.1', 'authorization_version' => config('security.authorization_version'),
            'authorization_text' => config('security.authorization_text'), 'status' => SecurityAssessment::Requested,
        ]);
    }
}
