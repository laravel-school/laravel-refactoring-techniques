<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'gender' => fake()->randomElement(['man', 'woman']),
            'createdby' => fake()->randomElement(['admin', 'user']),
            'wanttobe' => fake()->randomElement(['sugardaddy', 'sugarbaby', null]),
            'aboutme' => fake()->paragraph(1),
            'lookingfordetails' => fake()->paragraph(1),
            'tagline' => fake()->sentence(1),
            'username' => fake()->unique()->userName,
            'profilephoto' => fake()->imageUrl(400, 400, 'people'), // URL to a random 400x400 people image
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
