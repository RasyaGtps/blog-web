# ByRead - Platform Blogging Modern 🚀

<div align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  
  [![GitHub license](https://img.shields.io/github/license/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/blob/main/LICENSE)
  [![GitHub stars](https://img.shields.io/github/stars/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/stargazers)
  [![GitHub forks](https://img.shields.io/github/forks/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/network)
  [![GitHub issues](https://img.shields.io/github/issues/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/issues)
</div>

## 🌟 Tentang ByRead

ByRead adalah platform blogging modern yang memungkinkan penulis berbagi ide dan pengetahuan mereka dalam format yang elegan. Dibangun dengan Laravel dan Tailwind CSS, platform ini menawarkan pengalaman menulis dan membaca yang optimal dengan berbagai fitur canggih.

### ✨ Fitur Utama

- 📝 Sistem Artikel
  - Editor teks yang mudah digunakan
  - Dukungan untuk artikel premium dan gratis
  - Sistem tag untuk kategorisasi
  - Statistik pembaca dan engagement

- 👤 Manajemen Pengguna
  - Sistem verifikasi penulis
  - Profil yang dapat disesuaikan
  - Avatar dan bio pengguna
  - Statistik artikel dan followers

- 🤝 Interaksi Sosial
  - Sistem follow/following
  - Komentar dan balasan
  - Notifikasi real-time
  - Berbagi artikel

- 💎 Fitur Premium
  - Paket keanggotaan (Basic/Premium)
  - Konten eksklusif
  - Badge khusus untuk penulis terverifikasi
  - Statistik detail

## 🚀 Memulai

### Persyaratan Sistem

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Git

### 🛠️ Instalasi

1. Clone repositori
```bash
git clone https://github.com/RasyaGtps/blog-web.git
cd blog-web
```

2. Install dependensi
```bash
composer install
npm install
```

3. Konfigurasi environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Setup database di .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=byread
DB_USERNAME=root
DB_PASSWORD=
```

5. Migrasi dan seeding
```bash
php artisan migrate --seed
php artisan storage:link
```

6. Compile assets dan jalankan server
```bash
npm run dev
php artisan serve
```

## 📱 Fitur Detail

### Sistem Artikel
- Dukungan markdown
- Upload gambar cover
- Estimasi waktu baca
- Sistem draft & publikasi
- Tag dan kategori
- Statistik view & engagement

### Manajemen Pengguna
- Sistem role (admin/verified/user)
- Profil kustom dengan avatar
- Dashboard statistik
- Manajemen artikel
- Pengaturan notifikasi

### Membership
- Paket Basic & Premium
- Pembayaran terintegrasi
- Konten eksklusif
- Badge khusus
- Statistik detail

### Interaksi
- Komentar & balasan
- Follow/Unfollow
- Notifikasi real-time
- Share artikel
- Like & bookmark

## 🛠️ Tech Stack

- **Backend**: Laravel 10
- **Frontend**: 
  - Tailwind CSS
  - Alpine.js
  - Blade Templates
- **Database**: MySQL
- **Tools**: 
  - Vite
  - Laravel Mix
  - Composer
  - NPM

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan:
1. Fork repositori
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📜 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

## 👨‍💻 Author

**Rayy (RasyaGtps)**
- GitHub: [@RasyaGtps](https://github.com/RasyaGtps)

---

<div align="center">
  Made with ❤️ by Rayy
  <br>
  © 2024 ByRead. All rights reserved.
</div>
