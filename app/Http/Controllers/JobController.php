<?php

namespace App\Http\Controllers;

use App\Models\{Job, Tag};
use App\Http\Requests\StoreJobRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Services\TagService;

class JobController extends Controller
{
    public function __construct(private TagService $tagService)
    {
        $this->authorizeResource(Job::class, 'job');
    }

    public function index(): View
    {
        $jobs = Job::query()
            ->latest()
            ->with(['employer', 'tags'])
            ->simplePaginate(9);

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

        $this->tagService->attachTags($job, $attributes['tags'] ?? null);

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job created successfully!');
    }

    public function edit(Job $job): View
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(StoreJobRequest $request, Job $job): RedirectResponse
    {
        $attributes = $request->validated();

        $job->update(Arr::except($attributes, 'tags'));

        $this->tagService->syncTags($job, $attributes['tags'] ?? null);

        return redirect()
            ->route('jobs.show', $job)
            ->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job deleted successfully!');
    }
}