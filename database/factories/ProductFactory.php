<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $nama = fake()->unique()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'user_id'     => User::factory(),
            'name'        => ucwords($nama),
            'slug'        => Str::slug($nama),
            'description' => fake()->sentence(12),
            'price'       => fake()->numberBetween(15, 900) * 1000,
            'stock'       => fake()->numberBetween(0, 200),
            'is_active'   => fake()->boolean(90),
        ];
    }
}
