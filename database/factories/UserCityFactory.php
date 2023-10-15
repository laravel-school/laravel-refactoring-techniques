<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usercity>
 */
class UserCityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countries = [
            'unitedstates',
            'singapore',
            'thailand',
            'indonesia',
            'malaysia',
        ];

        return [
            'userid' => null,
            'currentcity' => $this->faker->city,
            'currentstate' => $this->faker->state,
            'currentcountry' => $this->faker->randomElement($countries),
            'currentlatlng' => $this->faker->latitude . ',' . $this->faker->longitude,
            'previouscity1' => $this->faker->city,
            'previousstate1' => $this->faker->state,
            'previouscountry1' => $this->faker->country,
            'previouslatlng1' => $this->faker->latitude . ',' . $this->faker->longitude,
            'previouscity2' => $this->faker->city,
            'previousstate2' => $this->faker->state,
            'previouscountry2' => $this->faker->country,
            'previouslatlng2' => $this->faker->latitude . ',' . $this->faker->longitude,
        ];
    }
}
