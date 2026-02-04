<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __invoke(Request $request): View
    {
        $searchTerm = $request->input('q');

        if (!$searchTerm) {
            return view('results', ['jobs' => collect()]);
        }

        $jobs = Job::query()
            ->with(['employer', 'tags'])
            ->where('title', 'LIKE', "%{$searchTerm}%")
            ->get();

        return view('results', compact('jobs'));
    }
}
