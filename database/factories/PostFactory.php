<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'title' => rtrim($title, '.'),
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 9999),
            'excerpt' => fake()->paragraph(),
            'body' => collect(fake()->paragraphs(6))->map(fn ($p) => $p."\n")->implode("\n"),
            'published_at' => fake()->dateTimeBetween('-6 months'),
        ];
    }

    public function draft(): static
    {
        return $this->state(['published_at' => null]);
    }
}
