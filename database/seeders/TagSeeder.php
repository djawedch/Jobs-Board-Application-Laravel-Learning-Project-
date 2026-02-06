<?php
/*

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'laravel', 'php', 'javascript', 'vue', 'react', 
            'nodejs', 'python', 'devops', 'backend', 'frontend',
            'fullstack', 'remote', 'design', 'ui/ux', 'mobile',
            'database', 'mysql', 'postgresql', 'api', 'testing'
        ];
        
        foreach ($tags as $tagName) 
        {
            Tag::factory()->create(['name' => $tagName]);
        }
        
        $jobs = \App\Models\Job::all();
        $allTags = Tag::all();
        
        foreach ($jobs as $job) {
            $randomTags = $allTags->random(rand(1, 3));
            $job->tags()->attach($randomTags);
        }
    }
}