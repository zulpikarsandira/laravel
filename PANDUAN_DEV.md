# 🚀 PANDUAN_DEV.md - Proyek Laravel "F*CK YOU"

Halo, Developer! 👋
Selamat datang di repo proyek yang super *bold* ini. Dokumen ini dibuat biar kamu nggak bingung pas mau ngoprek kodenya. Santai aja bacanya, kita bahas pake bahasa manusia.

## 🛠️ Persiapan Perang (Instalasi)

Sebelum mulai, pastiin laptop kamu udah siap tempur.
Syarat minimum:
- **PHP** (minimal 8.2)
- **Composer** (buat ngurus PHP)
- **Node.js & NPM** (buat ngurus tampilan/Vite)

> **Mau share project ke HP/Teman?** Baca [CARA_SHARE.md](./CARA_SHARE.md) ya!

### Cara Install & Jalanin:

1.  **Clone Repo** (atau copy foldernya)
2.  **Install Dependensi Backend (PHP)**
    ```bash
    composer install
    ```
3.  **Install Dependensi Frontend (JS/CSS)**
    ```bash
    npm install
    ```
4.  **Siapkan Database**
    ```bash
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    ```
5.  **Jalanin Proyek (PENTING! Butuh 2 Terminal)**
    
    Terminal 1 (Server PHP):
    ```bash
    php artisan serve
    ```
    
    Terminal 2 (Server Frontend/Vite):
    ```bash
    npm run dev
    ```

    Buka browser di: `http://127.0.0.1:8000` 🌍

---

## 📂 Struktur Folder (Peta Lokasi)

Biar nggak tersesat, ini peta lokasi file-file penting yang mungkin mau kamu edit:

- **`resources/views/welcome.blade.php`** 🎨
  *   Ini **HTML** utamanya. Cuma kerangka doang, isinya dikit karena styling & logika udah dipisah.
  *   Edit ini kalau mau nambah elemen HTML baru.

- **`resources/css/app.css`** 💅
  *   Tempat **CSS** dan **Tailwind**.
  *   Mau ubah animasi terbang? Ubah warna teks? Di sini tempatnya. Cari class `.flying-text`.

- **`resources/js/app.js`** 🧠
  *   Otaknya ada di sini (JavaScript).
  *   Logika klik, bikin elemen baru, timer animasi, semuanya diatur di file ini.

## 🧑‍💻 Dimana File PHP-nya? (Backend)

Kalau mau ngotak-ngatik logika server atau route:

- **`routes/web.php`** 🚦
  *   Ini buat ngatur URL. Misal mau bikin halaman baru `/about`, daftarin di sini.

- **`app/Http/Controllers/`** 🎮
  *   Tempat logika bisnis. Kalau aplikasinya makin kompleks, logic dipindah ke sini biar rapi.

- **`app/Models/`** 🗄️
  *   Jembatan ke Database.

---

## 🔧 Cara Modifikasi

### "Gue mau ganti tulisan 'fuckyou' nya!"
Gampang. Buka `resources/js/app.js`, cari baris:
```javascript
text.innerText = 'fuckyou';
```
Ganti sesuka hati, misal jadi `'I Love U'` (ciee).

### "Gue mau ganti warna/ukuran teks!"
Buka file yang sama (`resources/js/app.js`), cari bagian `text.className`.
Kamu bisa ganti class Tailwind-nya, misal ganti `text-red-500` jadi `text-blue-500`.

### "Gue mau animasinya lebih lambat!"
Buka `resources/css/app.css`. Cari `.flying-text` dan ubah `transition: all 0.8s`. Ganti angkanya jadi makin gede (misal `2s`) biar makin slow motion.

---

## ⚠️ Catatan Penting
Kalau kamu ubah file CSS atau JS, **JANGAN LUPA** pastikan `npm run dev` lagi jalan di terminal. Kalau nggak, perubahan kamu nggak bakal kelihatan karena Vite-nya mati.

Selamat berkarya! Jangan lupa ngopi. ☕
