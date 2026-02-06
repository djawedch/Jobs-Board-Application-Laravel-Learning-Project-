<?php

namespace App\Http\Controllers;

use App\Models\{Job, Tag};
use App\Http\Requests\StoreJobRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(): View
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

    public function create(): View
    {
        $this->authorize('create', Job::class);

        return view('jobs.create');
    }

    public function store(StoreJobRequest $request): RedirectResponse
    {
        $attributes = $request->validated();
        
        $employer = $request->user()->employer;

        $job = $employer->jobs()->create(
            Arr::except($attributes, 'tags')
        );

        $this->attachTags($job, $attributes['tags'] ?? null);

        return redirect()->route('jobs.index');
    }

    public function show(Job $job): View
    {
        return view('jobs.show', ['job' => $job]);
    }

    private function attachTags(Job $job, ?string $tags): void
    {
        if (!$tags) {
            return;
        }

        collect(explode(',', $tags))
            ->map(fn($tag) => trim($tag))
            ->filter()
            ->each(fn($tag) => $job->tag($tag));
    }
}
