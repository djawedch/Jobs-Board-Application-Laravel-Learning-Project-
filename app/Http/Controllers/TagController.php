<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;

class TagController extends Controller
{
    public function __invoke(Tag $tag): View
    {
        $tag->load(['jobs.employer', 'jobs.tags']);
        
        return view('results', ['jobs' => $tag->jobs]);
    }
}
