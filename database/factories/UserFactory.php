<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Photo;
use App\Models\Usercity;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $countries = [
            'unitedstates',
            'singapore',
            'thailand',
            'indonesia',
            'malaysia',
        ];

        return [
            'aboutme' => $this->faker->paragraph,
            'hasapprovedaboutme' => $this->faker->boolean,
            'lookingfordetails' => $this->faker->paragraph,
            'hasapprovedlookingfor' => $this->faker->boolean,
            'fullname' => $this->faker->name,
            'birthday' => $this->faker->randomDigitNotNull,
            'birthmonth' => $this->faker->monthName,
            'birthyear' => $this->faker->year,
            'gender' => $this->faker->randomElement(['man', 'woman']),
            'wanttobe' => $this->faker->word,
            'interest' => $this->faker->word,
            'lifestyle' => $this->faker->sentence(3),
            'networth' => $this->faker->sentence(2),
            'annualincome' => $this->faker->sentence(2),
            'username' => $this->faker->userName,
            'isusernameapproved' => $this->faker->boolean,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('secret'),
            'profilephoto' => $this->faker->imageUrl(),
            'tagline' => $this->faker->sentence,
            'hasapprovedtagline' => $this->faker->boolean,
            'activationcode' => $this->faker->uuid,
            'remember_token' => Str::random(10),
            'flag' => $this->faker->boolean,
            'issuspended' => $this->faker->boolean,
            'membershiptype' => $this->faker->randomElement(['free', 'paid']),
            'isverifiedaccount' => $this->faker->boolean,
            'isfeatured' => $this->faker->boolean,
            'isloggedin' => $this->faker->boolean,
            'isdoteduemail' => $this->faker->boolean,
            'featurehome' => $this->faker->boolean,
            'createdby' => $this->faker->userName,
            'issuspendedfor' => $this->faker->word,
            'featuredin' => $this->faker->randomElement($countries),
            'email_verified_at' => $this->faker->dateTime(),
            'featuredsince' => $this->faker->dateTime(),
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
