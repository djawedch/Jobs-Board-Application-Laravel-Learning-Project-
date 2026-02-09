@props(['tag'])

<a class="bg-white/10 hover:bg-white/25 rounded-xl font-bold transition-colors duration-300 px-3 py-1 text-xs">
    {{ $tag->name }}
</a>