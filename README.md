# ByRead - Platform Blogging Modern Indonesia 🚀

<div align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  
  [![GitHub license](https://img.shields.io/github/license/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/blob/main/LICENSE)
  [![GitHub stars](https://img.shields.io/github/stars/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/stargazers)
  [![GitHub forks](https://img.shields.io/github/forks/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/network)
  [![GitHub issues](https://img.shields.io/github/issues/RasyaGtps/blog-web)](https://github.com/RasyaGtps/blog-web/issues)
</div>

## 🌟 Tentang ByRead

ByRead adalah platform blogging modern Indonesia yang dirancang untuk memberikan pengalaman menulis dan membaca yang optimal. Dengan fokus pada konten berkualitas dan interaksi komunitas, ByRead menjadi wadah bagi penulis untuk berbagi cerita, ide, dan pengetahuan mereka dalam format yang elegan dan profesional.

### ✨ Fitur Utama

- 📝 Sistem Artikel
  - Editor teks modern dengan dukungan markdown
  - Sistem artikel premium dan gratis
  - Kategorisasi dengan tag yang fleksibel
  - Analitik artikel (views, read time, engagement)
  - Cover image yang responsif
  - Auto-save dan sistem draft

- 👥 Profil & Komunitas
  - Profil penulis yang dapat dikustomisasi
  - Sistem verifikasi penulis
  - Avatar dan bio yang menarik
  - Follow/Following system
  - Statistik profil lengkap

- 💎 Membership Premium
  - Akses ke konten eksklusif
  - Badge khusus untuk penulis terverifikasi
  - Statistik detail pembaca
  - Fitur prioritas dan preview
  - Dukungan monetisasi

- 🤝 Interaksi & Engagement
  - Sistem komentar yang interaktif
  - Notifikasi real-time
  - Bookmark artikel
  - Share ke media sosial
  - Like dan rating sistem

## 🚀 Memulai

### Persyaratan Sistem

- PHP >= 8.1
- Composer 2.x
- Node.js >= 16
- MySQL/MariaDB >= 8.0
- Git

### 🛠️ Instalasi

1. Clone repositori
```bash
git clone https://github.com/RasyaGtps/blog-web.git
cd blog-web
```

2. Install dependensi PHP dan Node.js
```bash
composer install
npm install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Konfigurasi database di .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=byread
DB_USERNAME=root
DB_PASSWORD=
```

5. Migrasi database dan storage
```bash
php artisan migrate --seed
php artisan storage:link
```

6. Compile assets dan jalankan server
```bash
npm run dev
php artisan serve
```

## 🎯 Fitur Detail

### Sistem Artikel
- Rich text editor dengan dukungan markdown
- Upload dan optimasi gambar otomatis
- Sistem tag dan kategori yang fleksibel
- Estimasi waktu baca otomatis
- Draft dan preview artikel
- Statistik pembaca real-time

### Profil & Komunitas
- Kustomisasi profil lengkap
- Sistem role (admin/verified/regular)
- Dashboard statistik personal
- Manajemen artikel dan followers
- Notifikasi aktivitas

### Membership Premium
- Paket Basic dan Premium
- Pembayaran terintegrasi
- Konten eksklusif premium
- Badge dan fitur khusus
- Analitik detail

### Interaksi
- Komentar dan threading
- Follow/Unfollow sistem
- Notifikasi real-time
- Social sharing
- Bookmark dan like

## 🛠️ Tech Stack

- **Backend**: 
  - Laravel 10.x
  - PHP 8.1+
  - MySQL/MariaDB

- **Frontend**: 
  - Tailwind CSS 3
  - Alpine.js 3
  - Blade Templates
  - Font Awesome Icons

- **Tools & Services**: 
  - Vite
  - Laravel Mix
  - Composer
  - NPM
  - Git

## 🤝 Kontribusi

Kami sangat menghargai kontribusi dari komunitas! Berikut langkah-langkah untuk berkontribusi:

1. Fork repositori ini
2. Buat branch fitur baru (`git checkout -b feature/NamaFitur`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin feature/NamaFitur`)
5. Buat Pull Request

Pastikan untuk:
- Mengikuti coding style yang ada
- Menambahkan dokumentasi yang diperlukan
- Menulis test jika diperlukan
- Update README jika ada perubahan signifikan

## 📜 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## 👨‍💻 Author

**Rayy (RasyaGtps)**
- GitHub: [@RasyaGtps](https://github.com/RasyaGtps)

---

<div align="center">
  <p>Made with ❤️ in Indonesia</p>
  <p>© 2024 ByRead. All rights reserved.</p>
</div>
