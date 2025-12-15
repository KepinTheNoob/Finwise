<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Kevin Test',
            'email' => 'kevin@example.com',
            'password' => bcrypt('password'),
        ]);

        $incomeCats = \App\Models\Category::factory(5)->create([
            'user_id' => $user->id,
            'type' => 'income'
        ]);

        $expenseCats = \App\Models\Category::factory(5)->create([
            'user_id' => $user->id,
            'type' => 'expense'
        ]);

        foreach ($incomeCats->merge($expenseCats) as $cat) {
            \App\Models\Transaction::factory(5)->create([
                'user_id' => $user->id,
                'category_id' => $cat->id,
                'type' => $cat->type
            ]);
        }

        foreach ($expenseCats as $cat) {
            \App\Models\Budget::factory()->create([
                'user_id' => $user->id,
                'category_id' => $cat->id,
            ]);
        }
    }
}
