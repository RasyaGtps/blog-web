<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Kami - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<body class="bg-white">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <!-- Premium Banner -->
    <div class="bg-[#FDF6F0] border-b border-gray-200">
        <div class="max-w-[1200px] mx-auto px-4 py-3">
            <div class="flex items-center justify-center gap-2 text-sm">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->membership === 'free'): ?>
                        <span class="text-yellow-600">✨</span>
                        <span>Dapatkan akses tanpa batas ke konten terbaik ByRead mulai dari Rp 29K/bulan.</span>
                        <a href="<?php echo e(route('membership.index')); ?>" class="font-semibold underline hover:text-gray-600">
                            Jadi Anggota
                        </a>
                    <?php elseif(Auth::user()->membership === 'basic'): ?>
                        <span class="text-yellow-600">✨</span>
                        <span>Terima kasih telah bergabung sebagai member Paket Dasar!</span>
                    <?php elseif(Auth::user()->membership === 'premium'): ?>
                        <span class="text-yellow-600">✨</span>
                        <span>Terima kasih telah bergabung sebagai member Premium!</span>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="text-yellow-600">✨</span>
                    <span>Dapatkan akses tanpa batas ke konten terbaik ByRead mulai dari Rp 29K/bulan.</span>
                    <a href="<?php echo e(route('membership.index')); ?>" class="font-semibold underline hover:text-gray-600">
                        Jadi Anggota
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-[1200px] mx-auto px-4 py-8">
        <!-- Categories/Tags -->
        <div class="flex items-center gap-6 border-b border-gray-200 pb-4 mb-8 overflow-x-auto">
            <a href="<?php echo e(route('stories.index')); ?>" class="text-sm font-medium whitespace-nowrap <?php echo e(!request('tag') && !request('filter') ? 'text-black' : 'text-gray-500 hover:text-black'); ?>">
                Untuk Anda
            </a>
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('stories.index', ['filter' => 'following'])); ?>" 
                   class="text-sm font-medium whitespace-nowrap <?php echo e(request('filter') === 'following' ? 'text-black' : 'text-gray-500 hover:text-black'); ?>">
                    Diikuti
                </a>
            <?php endif; ?>
            <?php if(isset($tags) && $tags->count() > 0): ?>
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('stories.index', ['tag' => $tag->name])); ?>" 
                       class="text-sm font-medium whitespace-nowrap <?php echo e(request('tag') === $tag->name ? 'text-black' : 'text-gray-500 hover:text-black'); ?>">
                        <?php echo e($tag->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <!-- Articles List -->
        <div class="grid grid-cols-12 gap-8">
            <!-- Main Articles Column -->
            <div class="col-span-12 md:col-span-8">
                <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="mb-8 pb-8 border-b border-gray-200">
                    <div class="flex items-center gap-2 mb-3">
                        <?php if($article->user->avatar): ?>
                        <img src="/avatars/<?php echo e($article->user->avatar); ?>"
                            alt="<?php echo e($article->user->username); ?>"
                            class="w-6 h-6 rounded-full">
                        <?php else: ?>
                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($article->user->username)); ?>"
                            alt="<?php echo e($article->user->username); ?>"
                            class="w-6 h-6 rounded-full">
                        <?php endif; ?>
                        <a href="<?php echo e(route('profile.show', $article->user->username)); ?>" class="text-sm"><?php echo e($article->user->username); ?></a>
                        <?php if($article->user->role === 'verified'): ?>
                        <span class="text-sm text-blue-600">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        <?php endif; ?>
                        <?php if($article->user->role === 'admin'): ?>
                        <span class="text-sm text-purple-600" title="Developer">
                            <i class="fas fa-code"></i>
                        </span>
                        <?php endif; ?>
                        <span class="text-gray-500 text-sm">· <?php echo e($article->created_at->format('M d')); ?></span>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold mb-2 font-serif">
                                <a href="<?php echo e(route('articles.show', $article)); ?>"
                                    class="text-black hover:text-gray-700">
                                    <?php echo e($article->title); ?>

                                    <?php if($article->type === 'premium'): ?>
                                        <span class="inline-flex items-center justify-center ml-2 px-1.5 py-0.5 bg-yellow-100 rounded text-yellow-600 text-sm" title="Premium Article">
                                            <i class="fas fa-crown"></i>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </h2>
                            <p class="text-gray-600 mb-3 line-clamp-2 text-base">
                                <?php echo e($article->description); ?>

                            </p>
                            <div class="flex items-center gap-4 text-sm">
                                <div class="flex flex-wrap gap-2">
                                    <?php $__currentLoopData = $article->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('stories.index', ['tag' => $tag->name])); ?>" 
                                           class="bg-gray-100 px-3 py-1 rounded-full text-gray-600 text-sm hover:bg-gray-200 transition-colors">
                                            #<?php echo e($tag->name); ?>

                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <span class="text-gray-500"><?php echo e($article->read_time ?? '5'); ?> min read</span>
                                <span class="flex items-center gap-1 text-gray-500">
                                    <i class="far fa-eye"></i>
                                    <?php echo e($article->views); ?>

                                </span>
                                <span class="flex items-center gap-1 text-gray-500">
                                    <i class="far fa-comment"></i>
                                    <?php echo e($article->comments->count()); ?>

                                </span>
                            </div>
                        </div>
                        <?php if($article->image): ?>
                        <img src="<?php echo e($article->image); ?>"
                            alt="<?php echo e($article->title); ?>"
                            class="w-32 h-32 object-cover rounded">
                        <?php endif; ?>
                    </div>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-12">
                    <?php if(request('filter') === 'following'): ?>
                        <i class="fas fa-users text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Belum ada artikel dari penulis yang Anda ikuti.</p>
                        <?php if(auth()->guard()->guest()): ?>
                            <p class="text-gray-500 mt-2">
                                <a href="<?php echo e(route('login')); ?>" class="text-blue-600 hover:underline">Login</a> untuk mulai mengikuti penulis.
                            </p>
                        <?php endif; ?>
                    <?php else: ?>
                        <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Belum ada artikel yang dipublikasikan.</p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Pagination -->
                <?php if($articles->hasPages()): ?>
                <div class="mt-8">
                    <?php echo e($articles->appends(request()->query())->links()); ?>

                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="hidden md:block col-span-4">
                <div class="sticky top-4">
                    <div class="bg-[#FDF6F0] rounded-lg p-6 mb-6">
                        <h3 class="font-bold mb-4">Artikel Pilihan</h3>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $randomArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <a href="<?php echo e(route('articles.show', $article)); ?>" class="block">
                                    <h4 class="text-sm font-medium hover:text-gray-600 line-clamp-2 mb-2">
                                        <?php echo e($article->title); ?>

                                        <?php if($article->type === 'premium'): ?>
                                            <span class="inline-flex items-center justify-center ml-1 px-1 py-0.5 bg-yellow-100 rounded text-yellow-600" title="Premium Article">
                                                <i class="fas fa-crown text-[10px]"></i>
                                            </span>
                                        <?php endif; ?>
                                    </h4>
                                </a>
                                <div class="flex items-center gap-2">
                                    <?php if($article->user->avatar): ?>
                                        <img src="/avatars/<?php echo e($article->user->avatar); ?>" 
                                             alt="<?php echo e($article->user->username); ?>" 
                                             class="w-6 h-6 rounded-full object-cover">
                                    <?php else: ?>
                                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($article->user->username)); ?>" 
                                             alt="<?php echo e($article->user->username); ?>" 
                                             class="w-6 h-6 rounded-full">
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('profile.show', $article->user->username)); ?>" 
                                       class="text-sm text-gray-600 hover:text-gray-800">
                                        <?php echo e($article->user->username); ?>

                                    </a>
                                    <?php if($article->user->role === 'verified'): ?>
                                        <span class="text-blue-600" title="Verified">
                                            <i class="fas fa-check-circle text-xs"></i>
                                        </span>
                                    <?php endif; ?>
                                    <?php if($article->user->role === 'admin'): ?>
                                        <span class="text-purple-600" title="Developer">
                                            <i class="fas fa-code text-xs"></i>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-bold mb-4">Topik yang Direkomendasikan</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php if(isset($tags) && $tags->count() > 0): ?>
                            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('stories.index', ['tag' => $tag->name])); ?>" 
                               class="inline-flex items-center px-3 py-1 rounded-full text-sm <?php echo e(request('tag') === $tag->name ? 'bg-gray-800 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-800'); ?> transition-colors">
                                <span class="<?php echo e(request('tag') === $tag->name ? 'text-gray-300' : 'text-gray-600'); ?>">#</span>
                                <span><?php echo e($tag->name); ?></span>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <span class="text-gray-500 text-sm">Belum ada topik tersedia</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH C:\project-rasya\blogging\resources\views/stories/index.blade.php ENDPATH**/ ?>