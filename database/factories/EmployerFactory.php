<?php
/*

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'logo' => fake()->imageUrl,
            'user_id' => User::factory(),
        ];
    }
}