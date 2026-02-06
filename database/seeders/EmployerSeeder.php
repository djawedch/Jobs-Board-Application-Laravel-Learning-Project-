<?php
/*

namespace Database\Seeders;

use App\Models\Employer;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    public function run(): void
    {
        $usersWithoutEmployer = \App\Models\User::doesntHave('employer')->get();
        
        foreach ($usersWithoutEmployer->take(3) as $user) {
            Employer::factory()->create(['user_id' => $user->id]);
        }
    }
}
