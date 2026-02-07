<?php

namespace App\Http\Controllers;

use App\Models\{Job};
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __invoke(Request $request): View
    {
        $request->validate([
            'q' => 'required|string|min:2|max:100',
        ], [
            'q.required' => 'Please enter a job title, or tag name to search.',
            'q.min' => 'Search term must be at least 2 character.',
            'q.max' => 'Search term is too long (maximum 100 characters).',
        ]);

        $searchTerm = $request->input('q');

        $jobs = Job::query()
            ->with(['employer', 'tags'])
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('tags', function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', "%{$searchTerm}%");
                    });
            })
            ->latest()
            ->simplePaginate(10);

        $jobs->appends(['q' => $searchTerm]);

        return view('results', compact('jobs'));
    }
}
