<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NG-LOCO</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body
    class="bg-gray-900 text-white flex items-center justify-center h-screen overflow-hidden cursor-pointer select-none">

    <div class="text-center pointer-events-none relative z-10">
        <h1 class="text-9xl font-black uppercase tracking-tighter drop-shadow-lg animate-pulse text-red-600">
            NG-LOCO
        </h1>
        <p class="text-2xl font-light tracking-widest mt-4 text-gray-400">
            NGoding LOw COde
        </p>
    </div>

</body>

</html>