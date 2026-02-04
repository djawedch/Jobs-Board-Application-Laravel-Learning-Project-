<?php

namespace App\Http\Controllers;

use App\Models\{Job, Tag};
use App\Http\Requests\StoreJobRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->latest()
            ->with(['employer', 'tags'])
            ->get();

        return view('jobs.index', [
            'jobs' => $jobs,
            'tags' => Tag::all(),
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(StoreJobRequest $request)
    {
        $attributes = $request->validated();

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        $this->attachTags($job, $attributes['tags'] ?? null);

        return redirect()->route('jobs.index');
    }

    private function attachTags(Job $job, ?string $tags): void
    {
        if (! $tags) {
            return;
        }

        foreach(explode(',', $tags) as $tag) {
            $job->tag(trim($tag));
        }
    }
}
