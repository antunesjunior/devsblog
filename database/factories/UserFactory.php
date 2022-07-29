<?php

namespace Database\Factories;

use App\Helpers\UserHelper;
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
    public function definition()
    {
        $firstName =  $this->faker->firstName();
        $lastName  =  $this->faker->lastName();
        $username  =  UserHelper::generateUserName($firstName.$lastName);
        $url       = "www.".strtolower($firstName).strtolower($lastName).".com";

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $username,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'picture' => $this->faker->imageUrl(),
            'web' => $url,
            'bio' => $this->faker->sentence(),
            'company' => $this->faker->company(),
            'city' => $this->faker->city(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
