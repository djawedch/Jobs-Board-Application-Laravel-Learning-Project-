<?php
/*

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title' => fake()->jobTitle,
            'salary' => fake()->randomElement(['$50,000 USD', '$90,000 USD', '$150,000 USD']),
            'location' => 'Remote',
            'schedule' => 'Full Time',
            'url' => fake()->url,
            'featured' => false,
        ];
    }
}