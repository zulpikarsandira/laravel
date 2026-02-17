import './bootstrap';

// Logika Animasi NG-LOCO
document.addEventListener('click', function (e) {
    const text = document.createElement('div');
    text.innerText = 'NG-LOCO';
    // Ukuran teks lebih besar (text-4xl), warna merah terang
    text.className = 'flying-text text-4xl font-bold text-red-500';

    // Set posisi awal di kursor
    text.style.left = e.clientX + 'px';
    text.style.top = e.clientY + 'px';

    document.body.appendChild(text);

    // Trigger animasi bergerak ke tengah
    // Menggunakan setTimeout agar browser merender posisi awal dulu
    setTimeout(() => {
        text.classList.add('arrived');
    }, 50);

    // Hapus elemen setelah animasi selesai (0.8 detik)
    setTimeout(() => {
        text.remove();
    }, 850);
});
