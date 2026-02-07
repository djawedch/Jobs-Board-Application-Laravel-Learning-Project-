<x-layout>
    <div class="space-y-10">
        <section>
            <div class="mt-6 space-y-6">
                <x-job-card-wide :$job></x-job-card-wide>
            </div>
        </section>
    </div>

    <div class="mt-8 flex items-center justify-between">

        @can('delete', $job)
            <form method="POST" action="{{ route('jobs.destroy', $job) }}" onsubmit="return confirm('Delete this job?');">
                @csrf
                @method('DELETE')

                <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                    Delete
                </button>
            </form>
        @endcan

        <div class="flex gap-3">
            @can('update', $job)
                <a href="{{ route('jobs.index') }}"
                    class="px-4 py-2 rounded-md bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
                    Cancel
                </a>
                <a href="{{ route('jobs.edit', $job) }}"
                    class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 transition">
                    Edit
                </a>
            @endcan
        </div>

    </div>
</x-layout>