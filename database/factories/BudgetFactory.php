<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        $category = Category::where('user_id', $user->id)
            ->where('type', 'expense')
            ->inRandomOrder()
            ->first();

        if (!$category) {
            $category = Category::factory()->create([
                'user_id' => $user->id, 
                'type' => 'expense'
            ]);
        }

        return [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'period' => fake()->randomElement(['Monthly', 'Weekly', 'Yearly']),
            'amount' => fake()->randomFloat(2, 100000, 5000000),
        ];
    }
}