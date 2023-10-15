<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'userid' => null,
            'photomainid' => $this->faker->uuid,
            'isprivate' => $this->faker->randomElement([0, 1]),
            'flag' => $this->faker->randomElement([0, 1]),
            'temporaryapproved' => $this->faker->randomElement([0, 1]),
            'hasdeleted' => $this->faker->randomElement([0, 1]),
            'isapproved' => $this->faker->randomElement([0, 1]),
            'approvedby' => $this->faker->numberBetween(1, 5),
        ];
    }
}
