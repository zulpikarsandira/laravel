# 🌐 Cara Share Project ke HP / Teman

Mau pamer hasil codingan "NG-LOCO" ke HP sendiri atau ke laptop temen? Bisa banget!
Pilih salah satu cara di bawah ini:

## 1. Satu Wi-Fi (Paling Gampang & Cepat) 🏠
Cara ini cuma bisa kalau HP/Laptop teman kamu **connect ke Wi-Fi yang SAMA** dengan laptop kamu.

**Caranya:**
1.  Buka Terminal baru.
2.  Jalankan perintah sakti ini:
    ```bash
    php artisan serve --host 0.0.0.0
    ```
3.  Di HP/Laptop teman, buka browser dan ketik alamat IP laptop kamu:
    👉 **http://192.168.0.127:8000**

*(Catatan: IP `192.168.0.127` itu IP laptop kamu saat ini. Kalau ganti Wi-Fi, IP-nya mungkin berubah. Cek lagi pakai `hostname -I`)*

---

## 2. Beda Jaringan / Jarak Jauh (Pakai Internet) 🌍
Cara ini bisa buat pamer ke temen yang lagi di luar kota atau pakai data seluler (4G/5G). Kita pakai "terowongan" gratisan namanya **Serveo**.

**Caranya:**
1.  Pastikan project jalan dulu (`php artisan serve` di satu terminal).
2.  Buka Terminal BARU lagi.
3.  Ketik perintah ini:
    ```bash
    ssh -R 80:localhost:8000 serveo.net
    ```
4.  Nanti bakal muncul link (contoh: `https://budi.serveo.net`).
5.  Kasih link itu ke teman kamu. Beres!

---

**⚠️ PENTING:**
Saat share project, pastikan terminal `npm run dev` juga tetap jalan biar tampilan/animasinya nggak rusak ya!
