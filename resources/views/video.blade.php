<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NGALOCO - VIDEO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white flex flex-col items-center justify-center h-screen overflow-hidden">

    <!-- Video Container -->
    <div
        class="relative w-full max-w-4xl aspect-video bg-black rounded-lg shadow-2xl overflow-hidden border-4 border-yellow-500/50">
        <video class="w-full h-full object-cover" autoplay loop muted playsinline controls>
            <source src="{{ asset('videos/intro.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>
    </div>

    <!-- Back Button -->
    <div class="mt-8">
        <a href="/"
            class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-full transition duration-300 shadow-lg flex items-center gap-2">
            ⬅️ Kembali ke Menu Utama
        </a>
    </div>

</body>

</html>