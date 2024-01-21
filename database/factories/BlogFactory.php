<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>$this->faker->sentence(),
            'category_id'=>\App\Models\Category::factory(),
            'slug'=>$this->faker->slug(),
            'intro'=>$this->faker->sentence(),
            'body'=>$this->faker->paragraph(),
            'user_id'=>\App\Models\User::factory(),
        ];
    }
}
