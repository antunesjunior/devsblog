<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title =  $this->faker->unique()->sentence();
        $uri = Str::slug($title);

        return [
            'title' => $title,
            'uri' => $uri,
            'views' => $this->faker->numberBetween(100, 1000),
            'description' => $this->faker->sentence(),
            'cover' => $this->faker->imageUrl(),
            'content' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['posted', 'draft']),
            'user_id' => $this->faker->numberBetween(1, User::count()),
        ];
    }
}
