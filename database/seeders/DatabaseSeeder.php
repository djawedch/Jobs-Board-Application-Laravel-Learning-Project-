<?php
/*

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,        // Users must exist first
            EmployerSeeder::class,    // Then employers (needs users)
            JobSeeder::class,         // Then jobs (needs employers)
            TagSeeder::class,         // Then tags and relationships
        ]);
        
        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('👥 Users: ' . \App\Models\User::count());
        $this->command->info('🏢 Employers: ' . \App\Models\Employer::count());
        $this->command->info('💼 Jobs: ' . \App\Models\Job::count());
        $this->command->info('🏷️ Tags: ' . \App\Models\Tag::count());
    }
}
