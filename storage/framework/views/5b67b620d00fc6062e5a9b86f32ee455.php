<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Membership - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<body>
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="bg-[#FDF6F0]">
        <?php if(session('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-[1200px] mx-auto mt-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('error')); ?></span>
        </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-[1200px] mx-auto mt-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
        </div>
        <?php endif; ?>

        <div class="max-w-[1200px] mx-auto px-4 py-16">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-5xl font-serif font-bold mb-6">Bergabunglah dengan Komunitas Penulis Kami</h1>
                <p class="text-xl text-gray-600 mb-8">
                    Temukan cerita-cerita menarik, berbagi pengalaman, dan dukung penulis favorit Anda dalam satu platform.
                </p>
                <div class="flex items-center justify-center gap-4">
                    <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">
                        Masuk untuk Mulai
                    </a>
                    <?php else: ?>
                    <a href="<?php echo e(route('articles.create')); ?>" class="bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">
                        Mulai Menulis
                    </a>
                    <?php endif; ?>
                    <a href="#pricing" class="border-2 border-black px-8 py-3 rounded-full hover:bg-black hover:text-white transition-colors">
                        Lihat Paket
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white py-20">
            <div class="max-w-[1200px] mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-20">
                    <div class="space-y-6">
                        <h2 class="text-4xl font-serif font-bold">Mengapa Memilih ByRead?</h2>
                        <p class="text-gray-600 text-lg">Platform yang dirancang khusus untuk mendukung kreativitas dan pertumbuhan komunitas penulis Indonesia.</p>
                    </div>
                    <div class="grid gap-8">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-pen text-blue-600"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Kebebasan Berkreasi</h3>
                                <p class="text-gray-600">Tulis dan bagikan cerita Anda tanpa batas. Platform kami mendukung berbagai genre dan gaya penulisan.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-users text-green-600"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Komunitas Aktif</h3>
                                <p class="text-gray-600">Bergabung dengan komunitas penulis yang aktif dan supportif. Dapatkan masukan dan inspirasi dari sesama penulis.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-star text-purple-600"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Dukungan Pembaca</h3>
                                <p class="text-gray-600">Dapatkan dukungan langsung dari pembaca setia Anda melalui sistem keanggotaan yang transparan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="pricing" class="py-20">
            <div class="max-w-[1200px] mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-serif font-bold mb-4">Pilih Paket yang Sesuai</h2>
                    <p class="text-gray-600 text-lg">Temukan paket yang sesuai dengan kebutuhan Anda</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold mb-4">Gratis</h3>
                            <div class="text-4xl font-bold">Rp 0<span class="text-base font-normal text-gray-600">/bulan</span></div>
                        </div>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Baca 3 artikel premium/bulan</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Komentar dasar</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Akses artikel gratis</span>
                            </li>
                        </ul>
                        <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('register')); ?>" class="block w-full py-3 text-center border-2 border-black rounded-full hover:bg-black hover:text-white transition-colors">
                            Daftar Sekarang
                        </a>
                        <?php else: ?>
                        <?php if(Auth::user()->membership === 'free'): ?>
                        <button disabled class="w-full py-3 border-2 border-gray-300 text-gray-500 rounded-full cursor-not-allowed">
                            Paket Saat Ini
                        </button>
                        <?php else: ?>
                        <button disabled class="w-full py-3 border-2 border-gray-300 text-gray-500 rounded-full cursor-not-allowed">
                            <?php echo e(Auth::user()->membership === 'basic' ? 'Paket Dasar' : 'Paket Premium'); ?>

                        </button>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-md transform scale-105 relative">
                        <div class="absolute top-4 right-4">
                            <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">Terpopuler</span>
                        </div>
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold mb-4">Dasar</h3>
                            <div class="text-4xl font-bold">Rp 29K<span class="text-base font-normal text-gray-600">/bulan</span></div>
                        </div>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Artikel premium tanpa batas</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Fitur komentar lengkap</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Bebas iklan</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Dukungan untuk penulis</span>
                            </li>
                        </ul>
                        <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="block w-full py-3 text-center bg-black text-white rounded-full hover:bg-gray-800 transition-colors">
                            Masuk untuk Berlangganan
                        </a>
                        <?php else: ?>
                        <?php if(Auth::user()->membership === 'basic' || Auth::user()->membership === 'premium'): ?>
                        <button disabled class="w-full py-3 border-2 border-gray-300 text-gray-500 rounded-full cursor-not-allowed">
                            Paket Saat Ini
                        </button>
                        <?php else: ?>
                        <form action="<?php echo e(route('membership.request')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="type" value="basic">
                            <button type="submit" class="w-full py-3 bg-black text-white rounded-full hover:bg-gray-800 transition-colors">
                                Pilih Paket Dasar
                            </button>
                        </form>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold mb-4">Premium</h3>
                            <div class="text-4xl font-bold">Rp 49K<span class="text-base font-normal text-gray-600">/bulan</span></div>
                        </div>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Semua fitur Dasar</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Akses ke konten eksklusif</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Dukungan prioritas 24/7</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Akses awal ke fitur baru</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Analisis pembaca mendalam</span>
                            </li>
                        </ul>
                        <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="block w-full py-3 text-center border-2 border-black rounded-full hover:bg-black hover:text-white transition-colors">
                            Masuk untuk Berlangganan
                        </a>
                        <?php else: ?>
                        <?php if(Auth::user()->membership === 'premium'): ?>
                        <button disabled class="w-full py-3 border-2 border-gray-300 text-gray-500 rounded-full cursor-not-allowed">
                            Paket Saat Ini
                        </button>
                        <?php elseif(Auth::user()->membership === 'basic'): ?>
                        <form action="<?php echo e(route('membership.request')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="type" value="premium">
                            <button type="submit" class="w-full py-3 border-2 border-black rounded-full hover:bg-black hover:text-white transition-colors">
                                Upgrade ke Premium
                            </button>
                        </form>
                        <?php else: ?>
                        <form action="<?php echo e(route('membership.request')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="type" value="premium">
                            <button type="submit" class="w-full py-3 border-2 border-black rounded-full hover:bg-black hover:text-white transition-colors">
                                Pilih Premium
                            </button>
                        </form>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white py-20">
            <div class="max-w-[1200px] mx-auto px-4 text-center">
                <h2 class="text-4xl font-serif font-bold mb-6">Mulai Perjalanan Menulis Anda</h2>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Bergabunglah dengan ribuan penulis yang telah menemukan rumah mereka di ByRead.
                </p>
                <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">
                    Masuk untuk Mulai
                </a>
                <?php else: ?>
                <a href="<?php echo e(route('articles.create')); ?>" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">
                    Mulai Menulis
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH C:\project-rasya\blogging\resources\views/membership/index.blade.php ENDPATH**/ ?>