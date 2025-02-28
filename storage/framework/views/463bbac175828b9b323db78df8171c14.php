<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="container max-w-[1200px] mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="flex-grow">
                <div class="space-y-8">
                    <div class="max-w-4xl mx-auto px-4 py-8">
                        <div class="flex justify-between items-center mb-8">
                            <div>
                                <h1 class="text-2xl font-bold flex items-center gap-2">
                                    <i class="fas fa-book-open"></i>
                                    My Stories
                                </h1>
                                <p class="text-gray-600 mt-1 flex items-center gap-2">
                                    <i class="fas fa-user"></i>
                                    Welcome back, <?php echo e(auth()->user()->name); ?>!
                                </p>
                            </div>
                            <a href="<?php echo e(route('articles.create')); ?>" 
                               class="bg-black text-white px-6 py-2.5 rounded-full text-sm hover:bg-[#242424] transition-colors flex items-center gap-2">
                                <i class="fas fa-plus"></i>
                                Create Article
                            </a>
                        </div>

                        <?php if($articles->isEmpty()): ?>
                            <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                                <i class="fas fa-pen-fancy text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-600 mb-4">You haven't written any articles yet.</p>
                                <p class="text-sm text-gray-500">Share your thoughts with the world!</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="bg-white rounded-lg shadow-sm p-6">
                                        <div class="flex justify-between items-start">
                                            <h2 class="text-xl font-bold mb-2">
                                                <a href="<?php echo e(route('articles.show', $article)); ?>" 
                                                   class="text-black hover:text-gray-700">
                                                    <?php echo e($article->title); ?>

                                                </a>
                                            </h2>
                                            <div class="flex gap-3">
                                                <a href="<?php echo e(route('articles.edit', $article)); ?>" 
                                                   class="flex items-center gap-1 text-sm text-gray-600 hover:text-gray-900 transition-colors">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <form action="<?php echo e(route('articles.destroy', $article)); ?>" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to delete this article?');"
                                                      class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" 
                                                            class="flex items-center gap-1 text-sm text-gray-600 hover:text-red-600 transition-colors">
                                                        <i class="fas fa-trash-alt"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 mb-4">
                                            <?php echo e(Str::limit($article->content, 200)); ?>

                                        </p>
                                        <div class="flex items-center text-sm text-gray-500 gap-4">
                                            <span class="flex items-center gap-1">
                                                <i class="far fa-calendar-alt"></i>
                                                <?php echo e($article->created_at->format('d M Y')); ?>

                                            </span>
                                            <span class="flex items-center gap-1">
                                                <i class="far fa-eye"></i>
                                                <?php echo e($article->views); ?> views
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <i class="far fa-comment"></i>
                                                <?php echo e($article->comments->count()); ?> comments
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <?php if($articles->hasPages()): ?>
                                <div class="mt-6">
                                    <?php echo e($articles->links()); ?>

                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2" 
             x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 3000)">
            <i class="fas fa-check-circle"></i>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
</body>
</html>
<?php /**PATH C:\project-rasya\blogging\resources\views\dashboard.blade.php ENDPATH**/ ?>