<?php

namespace App\Http\Controllers;

use App\Models\{Job, Tag};
use App\Http\Requests\StoreJobRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class JobController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Job::class, 'job');
    }

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

    public function show(Job $job): View
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function create(): View
    {
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

    public function edit(Job $job): View
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(StoreJobRequest $request, Job $job): RedirectResponse
    {
        $attributes = $request->validated();

        $job->update(Arr::except($attributes, 'tags'));

        $this->syncTags($job, $attributes['tags'] ?? null);

        return redirect()->route('jobs.show', $job);
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index');
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

    private function syncTags(Job $job, ?string $tags): void
    {
        if (!$tags) {
            $job->tags()->detach();
            return;
        }

        $tagIds = collect(explode(',', $tags))
            ->map(fn($tag) => trim($tag))
            ->filter()
            ->map(fn($tag) => Tag::firstOrCreate(['name' => $tag])->id);

        $job->tags()->sync($tagIds);
    }
}
