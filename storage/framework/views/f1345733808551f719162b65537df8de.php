<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Stories - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="container max-w-[1200px] mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 flex items-center justify-center gap-3">
                <i class="fas fa-book-reader"></i>
                Our Stories
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover amazing stories from our community of writers. Get inspired, learn something new, or just enjoy a good read.
            </p>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-3">
                            <a href="<?php echo e(route('articles.show', $article)); ?>" 
                               class="text-black hover:text-gray-700">
                                <?php echo e($article->title); ?>

                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            <?php echo e($article->content); ?>

                        </p>
                        
                        <!-- Article Meta -->
                        <div class="flex items-center justify-between text-sm text-gray-500 mt-4 pt-4 border-t">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user-circle"></i>
                                <span><?php echo e($article->user->name); ?></span>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="flex items-center gap-1">
                                    <i class="far fa-eye"></i>
                                    <?php echo e($article->views); ?>

                                </span>
                                <span class="flex items-center gap-1">
                                    <i class="far fa-comment"></i>
                                    <?php echo e($article->comments->count()); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">No stories published yet.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if($articles->hasPages()): ?>
            <div class="mt-8">
                <?php echo e($articles->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</body>
</html> <?php /**PATH C:\project-rasya\blogging\resources\views\stories\index.blade.php ENDPATH**/ ?>