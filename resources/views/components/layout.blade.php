<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal App</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-black text-white pb-20">

    <x-flash-messages />

    <div class="px-10">
        <x-navigation />

        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>

</body>

</html>