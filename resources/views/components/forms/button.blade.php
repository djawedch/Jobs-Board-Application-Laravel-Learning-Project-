<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'bg-blue-800 text-white rounded py-2 px-6 font-bold transition-colors duration-200 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
    ]) }}
>
    {{ $slot }}
</button>