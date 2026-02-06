<?php
/*

namespace Database\Seeders;

use App\Models\{Job, Tag};
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $employers = \App\Models\Employer::all();

        foreach ($employers as $employer) {
            Job::factory(1)->create([
                'employer_id' => $employer->id,
            ]);
        }
    }
}
