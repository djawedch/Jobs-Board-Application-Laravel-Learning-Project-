<?php
/*

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

        User::factory(5)->hasEmployer(1)->create();
    }
}