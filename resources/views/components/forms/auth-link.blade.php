@props(['href', 'linkText'])

<div class="text-center text-sm text-gray-600 mt-6">
    {{ $slot }}
    <a href="{{ $href }}" class="font-medium text-blue-600 hover:underline">
        {{ $linkText }}
    </a>
</div>