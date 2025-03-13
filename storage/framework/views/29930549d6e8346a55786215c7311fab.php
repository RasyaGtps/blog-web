<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>ByRead - Platform Blogging Indonesia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-[#f8f6f2] text-black font-['Georgia'] flex flex-col min-h-screen">
    <div class="bg-white w-full border-b">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    
    <!-- Hero Section -->
    <section class="hero min-h-screen flex items-center justify-center bg-gradient-to-b from-white to-[#f8f6f2]">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-[85px] font-bold leading-[1] mb-8">Cerita & Ide Manusia</h1>
                <p class="text-2xl mb-8 text-gray-600">Sebuah Tempat membaca, menulis, dan memperdalam pemahaman Anda</p>
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center gap-2 bg-black text-white px-8 py-3 rounded-full text-lg hover:bg-gray-800 transition-colors">
                        <i class="fas fa-pen-to-square"></i>
                        Mulai Menulis
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <main>
        <!-- Featured Articles -->
        <section class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12" data-aos="fade-up">Artikel Pilihan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $featuredArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                            <?php if($article->cover_image): ?>
                                <img src="<?php echo e($article->cover_image); ?>" 
                                     alt="<?php echo e($article->title); ?>" 
                                     class="w-full h-48 object-cover rounded-t-xl">
                            <?php endif; ?>
                            <div class="p-6">
                                <div class="flex items-center gap-3 mb-4">
                                    <?php if($article->user->avatar): ?>
                                        <img src="/avatars/<?php echo e($article->user->avatar); ?>" 
                                             alt="<?php echo e($article->user->username); ?>" 
                                             class="w-8 h-8 rounded-full object-cover">
                                    <?php else: ?>
                                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-sm font-semibold text-gray-600 uppercase">
                                            <?php echo e(Str::substr($article->user->username, 0, 1)); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <p class="font-medium"><?php echo e($article->user->name); ?></p>
                                        <p class="text-sm text-gray-500"><?php echo e($article->created_at->format('M d, Y')); ?></p>
                                    </div>
                                </div>
                                <h3 class="font-bold text-xl mb-2 line-clamp-2">
                                    <a href="<?php echo e(route('articles.show', $article)); ?>" class="hover:text-blue-600 transition-colors">
                                        <?php echo e($article->title); ?>

                                    </a>
                                </h3>
                                <p class="text-gray-600 line-clamp-3 mb-4"><?php echo e($article->description); ?></p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span><?php echo e($article->read_time ?? '5'); ?> min read</span>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-bookmark"></i>
                                        <span>Save</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>

        <!-- Categories -->
        <section class="py-16">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12" data-aos="fade-up">Jelajahi Kategori</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" data-aos="fade-up">
                    <?php $__currentLoopData = ['Technology', 'Health', 'Business', 'Travel', 'Food', 'Lifestyle', 'Science', 'Culture']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#" class="group">
                            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow text-center">
                                <i class="fas fa-<?php echo e($category === 'Technology' ? 'laptop-code' : 
                                                  ($category === 'Health' ? 'heartbeat' : 
                                                  ($category === 'Business' ? 'chart-line' : 
                                                  ($category === 'Travel' ? 'plane' : 
                                                  ($category === 'Food' ? 'utensils' : 
                                                  ($category === 'Lifestyle' ? 'spa' : 
                                                  ($category === 'Science' ? 'flask' : 'palette'))))))); ?> 
                                   text-2xl mb-3 text-gray-600 group-hover:text-blue-600 transition-colors"></i>
                                <h3 class="font-medium group-hover:text-blue-600 transition-colors"><?php echo e($category); ?></h3>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>

        <!-- Why ByRead -->
        <section class="py-16 bg-white">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12 text-center" data-aos="fade-up">Mengapa ByRead?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center" data-aos="fade-up" data-aos-delay="0">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-pen-fancy text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Tulis dengan Bebas</h3>
                        <p class="text-gray-600">Platform yang memberikan kebebasan untuk menuangkan ide dan kreativitas Anda.</p>
                    </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-users text-2xl text-green-600"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Komunitas Aktif</h3>
                        <p class="text-gray-600">Bergabung dengan komunitas penulis dan pembaca yang aktif berbagi pengetahuan.</p>
                    </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-rocket text-2xl text-purple-600"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-3">Kembangkan Diri</h3>
                        <p class="text-gray-600">Tingkatkan kemampuan menulis dan perluas wawasan Anda bersama ByRead.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold mb-6" data-aos="fade-up">Mulai Menulis Cerita Anda</h2>
                <p class="text-xl mb-8 text-blue-100" data-aos="fade-up" data-aos-delay="100">
                    Bergabunglah dengan ribuan penulis yang telah membagikan ide dan pengalaman mereka di ByRead.
                </p>
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('register')); ?>" 
                       class="inline-flex items-center gap-2 bg-white text-blue-600 px-8 py-3 rounded-full text-lg hover:bg-blue-50 transition-colors"
                       data-aos="fade-up" data-aos-delay="200">
                        <i class="fas fa-user-plus"></i>
                        Daftar Sekarang
                    </a>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        const modal = document.getElementById('signUpModal');
        const closeModal = document.getElementById('closeModal');

        closeModal.addEventListener('click', function() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });

        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });

        const registerForm = document.getElementById('registerForm');
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            document.querySelectorAll('.error-message').forEach(el => {
                el.textContent = '';
                el.style.display = 'none';
            });

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Registration successful!');
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                    window.location.reload();
                } else {
                    Object.keys(result.errors || {}).forEach(key => {
                        const errorEl = document.getElementById(key + 'Error');
                        if (errorEl) {
                            errorEl.textContent = result.errors[key][0];
                            errorEl.style.display = 'block';
                        }
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred during registration. Please try again.');
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\project-rasya\blogging\resources\views/welcome.blade.php ENDPATH**/ ?>