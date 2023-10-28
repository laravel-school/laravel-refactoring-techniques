<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message' => $this->faker->text,
            'is_seen' => $this->faker->boolean,
            'isflagged' => $this->faker->boolean,
            'deleted_from_sender' => $this->faker->boolean,
            'deleted_from_receiver' => $this->faker->boolean,
            'user_id' => null,
            'conversation_id' => null,
        ];
    }
}
