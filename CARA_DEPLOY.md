# 🚀 Cara Deploy ke Vercel

Karena Laravel butuh PHP, kita pakai trik khusus biar bisa jalan di Vercel. Ikuti langkah ini pelan-pelan ya!

## 1. Persiapan GitHub (Sudah Beres)
Pastikan kodingan terakhir (termasuk file `vercel.json` yang baru saya buat) sudah di-push ke GitHub.
*(Nanti di akhir panduan ini saya akan bantu push otomatis)*.

## 2. Setup di Vercel Dashboard
1.  Buka [vercel.com](https://vercel.com) dan Login.
2.  Klik tombol **"Add New..."** -> **"Project"**.
3.  Pilih Repo GitHub **`laravel`** (atau nama repo kamu).
4.  Klik **"Import"**.

## 3. PENTING: Environment Variables
Di halaman "Configure Project", cari bagian **Environment Variables**.
Kamu WAJIB menambahkan ini biar Laravel bisa jalan aman:

| Key | Value |
| :--- | :--- |
| `APP_KEY` | *(Copy dari file .env di laptop kamu)* |
| `APP_DEBUG` | `true` (biar kalau error ketahuan) |
| `APP_URL` | Kosongkan dulu atau isi `https://nama-project.vercel.app` |

Cara dapat `APP_KEY`:
Buka file `.env` di laptop, cari baris `APP_KEY=base64:.....`, copy semua isinya.

## 4. Deploy!
1.  Klik tombol **"Deploy"**.
2.  Tunggu sebentar... Vercel akan install PHP & Composer.
3.  Kalau sukses, web kamu akan live! 🎉

---

## ⚠️ Masalah Umum (Troubleshooting)

### "Kok CSS-nya hilang / Tampilan Rusak?"
Itu karena link asetnya (CSS/JS) masih ngarah ke localhost atau HTTP biasa.
Solusi: Pastikan `npm run build` sudah dijalankan sebelum push (sudah kita lakukan tadi).

### "Error 500 / Blank Page"
Biasanya karena `APP_KEY` salah copy atau belum dimasukkan ke Environment Variables Vercel. Cek lagi langkah nomor 3.

Selamat mencoba! 🚀
