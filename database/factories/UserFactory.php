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
            'aboutme' => $this->faker->text,
            'hasapprovedaboutme' => $this->faker->boolean,
            'lookingfordetails' => $this->faker->text,
            'hasapprovedlookingfor' => $this->faker->boolean,
            'fullname' => $this->faker->name,
            'birthday' => $this->faker->dayOfMonth,
            'birthmonth' => $this->faker->monthName,
            'birthyear' => $this->faker->year,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'wanttobe' => $this->faker->word,
            'interest' => $this->faker->word,
            'lifestyle' => $this->faker->sentence,
            'networth' => $this->faker->word,
            'annualincome' => $this->faker->word,
            'username' => $this->faker->userName,
            'isusernameapproved' => $this->faker->boolean,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('secret'),
            'profilephoto' => $this->faker->imageUrl,
            'tagline' => $this->faker->sentence,
            'hasapprovedtagline' => $this->faker->boolean,
            'activationcode' => Str::random(128),
            'remember_token' => Str::random(10),
            'flag' => $this->faker->boolean,
            'issuspended' => $this->faker->boolean,
            'membershiptype' => $this->faker->word,
            'isverifiedaccount' => $this->faker->boolean,
            'isfeatured' => $this->faker->boolean,
            'isloggedin' => $this->faker->boolean,
            'isdoteduemail' => $this->faker->boolean,
            'createdby' => $this->faker->randomElement(['admin', 'user']),
            'issuspendedfor' => $this->faker->word,
            'email_verified_at' => $this->faker->dateTime,
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
