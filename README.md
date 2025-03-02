# ByRead - Blog Web Platform 🚀

<div align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  
  [![GitHub license](https://img.shields.io/github/license/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/blob/main/LICENSE)
  [![GitHub stars](https://img.shields.io/github/stars/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/stargazers)
  [![GitHub forks](https://img.shields.io/github/forks/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/network)
  [![GitHub issues](https://img.shields.io/github/issues/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/issues)
</div>

## 🌟 Tentang ByRead

ByRead adalah platform blogging modern yang dibangun dengan Laravel dan Tailwind CSS. Platform ini menyediakan pengalaman menulis dan membaca blog yang elegan dengan fitur-fitur canggih.

### ✨ Fitur Utama

- 📝 Editor artikel yang kaya fitur
- 👤 Manajemen profil pengguna
- 🖼️ Upload dan manajemen gambar
- 💬 Sistem komentar
- 👥 Fitur follow/following
- 🔍 Pencarian artikel
- 📱 Responsive design

## 🚀 Cara Menggunakan

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

2. Install dependensi PHP
```bash
composer install
```

3. Install dependensi JavaScript
```bash
npm install
```

4. Salin file environment
```bash
cp .env.example .env
```

5. Generate key aplikasi
```bash
php artisan key:generate
```

6. Konfigurasi database di file .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_web
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi database
```bash
php artisan migrate
```

8. Buat symbolic link untuk storage
```bash
php artisan storage:link
```

9. Compile assets
```bash
npm run dev
```

10. Jalankan server
```bash
php artisan serve
```

### 📝 Penggunaan

1. Registrasi akun baru atau login
2. Lengkapi profil dan upload avatar
3. Mulai menulis artikel
4. Jelajahi artikel dari penulis lain
5. Berikan komentar dan follow penulis favorit

## 🎨 Fitur Detail

### Manajemen Profil
- Upload avatar
- Edit informasi profil
- Lihat statistik artikel
- Kelola following/followers

### Artikel
- Editor WYSIWYG
- Upload gambar dalam artikel
- Draft dan publikasi
- Kategori dan tag
- Like dan bookmark

### Interaksi
- Sistem komentar
- Follow penulis
- Share artikel
- Notifikasi

## 🛠️ Teknologi yang Digunakan

- [Laravel](https://laravel.com) - Backend Framework
- [Tailwind CSS](https://tailwindcss.com) - Styling
- [Alpine.js](https://alpinejs.dev) - JavaScript Framework
- [MySQL](https://www.mysql.com) - Database
- [Vite](https://vitejs.dev) - Build Tool

## 📚 Dokumentasi API

Dokumentasi API lengkap dapat ditemukan di `/docs/api` setelah menjalankan:
```bash
php artisan l5-swagger:generate
```

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan buat pull request atau laporkan issue.

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
