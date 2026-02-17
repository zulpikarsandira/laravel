<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NGALOCO - VIDEO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white flex flex-col items-center justify-center h-screen overflow-hidden">

    <!-- Title -->
    <h1 class="text-4xl md:text-5xl font-black text-white mb-8 tracking-tighter uppercase drop-shadow-2xl">
        KATA KATA DARI <span class="text-yellow-500">KETUA</span>
    </h1>

    <!-- Video Container -->
    <div
        class="relative w-full max-w-4xl aspect-video bg-black rounded-lg shadow-2xl overflow-hidden border-4 border-yellow-500/50">
        <video id="introVideo" class="w-full h-full object-cover" autoplay loop playsinline controls>
            <source src="{{ asset('videos/intro.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>
    </div>

    <script>
        // Force Autoplay Logic (With Sound Attempt)
        document.addEventListener('DOMCon tentLoaded', function() {
            var video = document.getElementById('introVideo');
            
            // Try to play with sound
            video.muted = false;
            var promise = video.play();

            if (promise !== undefined) {
                promise.then(_ => {
                    // Autoplay started with sound!
                }).catch(error => {
                    // Browser blocked audio autoplay.
                    // Fallback: Mute and play, then unmute on first interact             console.log("Autoplay with sound blocked. Fallback to muted.");
                    video.muted = true;
                    video.play();
                });
            }
        });
    </script>

    <!-- Back Button -->
    <div class="mt-8">
        <a href="/"
            class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-full transition duration-300 shadow-lg flex items-center gap-2">
            ⬅️ Kembali ke Menu Utama
        </a>
    </div>

</body>

</html>