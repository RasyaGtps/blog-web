<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f8f6f2]">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        @include('layouts.navigation')
    </div>

    <!-- Hero Section -->
    <section class="bg-white py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-6">Tentang ByRead</h1>
            <p class="text-xl text-gray-600 leading-relaxed">
                Platform blogging yang dirancang untuk menghubungkan penulis kreatif dengan pembaca yang haus akan pengetahuan dan inspirasi di Indonesia.
            </p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold mb-6">Misi Kami</h2>
                    <p class="text-gray-600 mb-4">
                        ByRead hadir untuk memberikan platform yang memungkinkan setiap orang berbagi pengetahuan, pengalaman, dan ide-ide kreatif mereka dengan dunia.
                    </p>
                    <p class="text-gray-600">
                        Kami percaya bahwa setiap orang memiliki cerita yang layak untuk dibagikan dan setiap pembaca berhak mendapatkan konten berkualitas yang menginspirasi.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <i class="fas fa-users text-3xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Komunitas</h3>
                        <p class="text-gray-600">Membangun komunitas penulis dan pembaca yang saling mendukung</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <i class="fas fa-lightbulb text-3xl text-yellow-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Inovasi</h3>
                        <p class="text-gray-600">Menghadirkan fitur-fitur inovatif untuk pengalaman menulis yang lebih baik</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <i class="fas fa-shield-alt text-3xl text-green-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Kualitas</h3>
                        <p class="text-gray-600">Menjaga standar kualitas konten yang tinggi</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <i class="fas fa-globe text-3xl text-purple-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">Jangkauan</h3>
                        <p class="text-gray-600">Menjangkau pembaca dari berbagai latar belakang</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Fitur Unggulan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-[#f8f6f2] p-8 rounded-xl">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-pen-fancy text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Editor Ramah Pengguna</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span>Editor teks yang mudah digunakan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span>Dukungan format markdown</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span>Penyimpanan otomatis</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-[#f8f6f2] p-8 rounded-xl">
                    <div class="text-purple-600 mb-4">
                        <i class="fas fa-crown text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Keanggotaan Premium</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span>Akses ke konten eksklusif</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span>Fitur analitik lanjutan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span>Dukungan prioritas</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-[#f8f6f2] p-8 rounded-xl">
                    <div class="text-yellow-600 mb-4">
                        <i class="fas fa-comments text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Interaksi Komunitas</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span>Sistem komentar yang interaktif</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span>Fitur follow dan networking</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span>Chat langsung antar pengguna</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih ByRead?</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-sm">
                    <h3 class="text-xl font-bold mb-6">Untuk Penulis</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <div>
                                <h4 class="font-semibold mb-1">Platform yang Mendukung Kreativitas</h4>
                                <p class="text-gray-600">Tuangkan ide dan kreativitas Anda dengan tools yang mendukung</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <div>
                                <h4 class="font-semibold mb-1">Jangkauan Pembaca Luas</h4>
                                <p class="text-gray-600">Dapatkan pembaca dari seluruh Indonesia</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <div>
                                <h4 class="font-semibold mb-1">Monetisasi Konten</h4>
                                <p class="text-gray-600">Dapatkan penghasilan dari konten premium Anda</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm">
                    <h3 class="text-xl font-bold mb-6">Untuk Pembaca</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <div>
                                <h4 class="font-semibold mb-1">Konten Berkualitas</h4>
                                <p class="text-gray-600">Akses artikel bermutu dari penulis terpercaya</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <div>
                                <h4 class="font-semibold mb-1">Personalisasi Konten</h4>
                                <p class="text-gray-600">Temukan konten yang sesuai dengan minat Anda</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <div>
                                <h4 class="font-semibold mb-1">Interaksi Langsung</h4>
                                <p class="text-gray-600">Berinteraksi langsung dengan penulis favorit Anda</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Hubungi Kami</h2>
            <p class="text-gray-600 mb-8">
                Punya pertanyaan atau saran? Jangan ragu untuk menghubungi kami.
            </p>
            <a href="mailto:contact@byread.com" class="inline-flex items-center gap-2 bg-black text-white px-8 py-3 rounded-full text-lg hover:bg-gray-800 transition-colors">
                <i class="fas fa-envelope"></i>
                Kirim Email
            </a>
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.footer')
</body>
</html> 