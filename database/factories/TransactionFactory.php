<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        $category = Category::where('user_id', $user->id)->inRandomOrder()->first();

        if (!$category) {
            $category = Category::factory()->create(['user_id' => $user->id]);
        }

        return [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'amount' => fake()->randomFloat(2, 10000, 2000000),
            'type' => $category->type,
            'description' => fake()->sentence(3),
            'transaction_date' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}