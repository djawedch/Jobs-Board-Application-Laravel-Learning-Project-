<nav class="flex justify-between items-center py-4 border-b border-white/10">
    <div>
        <a href="{{ route('jobs.index') }}" class="px-4 py-2 rounded-lg font-medium text-indigo-600">
            Job Portal
        </a>
    </div>

    @auth
        <div class="space-x-6 font-bold flex">

            @can('create', App\Models\Job::class)
                <a href="{{ route('jobs.create') }}">Post a job</a>
            @endcan

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                @method('DELETE')

                <button>Log Out</button>
            </form>
        </div>
    @endauth

    @guest
        <div class="space-x-6 font-bold">
            <a href="{{ route('register') }}">Sign Up</a>
            <a href="{{ route('login') }}">Log In</a>
        </div>
    @endguest
</nav>