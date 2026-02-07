<x-layout>
    <x-page-heading>Results</x-page-heading>

    <div class="space-y-6">
        @forelse ($jobs as $job)
            <x-job-card-wide :$job></x-job-card-wide>
        @empty
            <p class="text-center text-gray-500 py-8">No jobs found matching your search.</p>
        @endforelse
    </div>

    @if($jobs->hasPages())
        <div class="mt-8">
            {{ $jobs->links() }}
        </div>
    @endif
</x-layout>