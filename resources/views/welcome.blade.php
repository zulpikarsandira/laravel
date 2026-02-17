<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NGALOCO</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body
    class="bg-gray-900 text-white flex flex-col items-center justify-center h-screen overflow-hidden cursor-pointer select-none font-sans">

    <div class="text-center relative z-10 px-4">
        <!-- Main Title -->
        <h1 class="text-6xl md:text-8xl font-black uppercase tracking-tighter drop-shadow-lg text-white mb-2">
            NGALOCO <span class="text-yellow-500">PAKE BUMBU</span> BATAGOR
        </h1>

        <!-- Subtitle -->
        <p class="text-3xl font-light tracking-widest text-gray-300 mb-10 italic">
            gass ngaloco
        </p>

        <!-- Button -->
        <a href="/video"
            class="px-8 py-4 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-full shadow-lg transform transition hover:scale-105 active:scale-95 text-xl tracking-wide ring-4 ring-yellow-500/30 inline-block">
            KLIK TOMBOL INI UNTUK LANJUT
        </a>
    </div>

</body>

</html>