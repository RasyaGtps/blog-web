<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($user->name); ?> - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex items-start space-x-6">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    <?php if($user->avatar): ?>
                        <img src="<?php echo e(asset('avatars/' . $user->avatar)); ?>" 
                             alt="<?php echo e($user->username); ?>" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-gray-200">
                    <?php else: ?>
                        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-2xl font-semibold text-gray-600 uppercase">
                            <?php echo e(Str::substr($user->username, 0, 2)); ?>

                        </div>
                    <?php endif; ?>
                </div>

                <!-- User Info -->
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <h1 class="text-2xl font-bold"><?php echo e($user->name); ?></h1>
                            <div class="flex items-center gap-1 text-gray-600">
                                <span><?php echo e('@' . $user->username); ?></span>
                                <?php if($user->role === 'verified'): ?>
                                    <span class="text-blue-600">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->user()->id !== $user->id): ?>
                                <div class="flex items-center gap-2">
                                    <a href="<?php echo e(route('chat.show', $user->id)); ?>" 
                                       class="flex items-center gap-2 bg-gray-100 text-gray-800 px-6 py-2.5 rounded-full hover:bg-gray-200 transition-colors">
                                        <i class="fas fa-comment"></i>
                                        <span>Chat</span>
                                    </a>
                                    <?php if(auth()->user()->isFollowing($user)): ?>
                                        <form action="<?php echo e(route('user.unfollow', $user)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" 
                                                    class="flex items-center gap-2 bg-gray-100 text-gray-800 px-6 py-2.5 rounded-full hover:bg-red-500 hover:text-white group transition-all">
                                                <i class="fas fa-user-check group-hover:hidden"></i>
                                                <i class="fas fa-user-times hidden group-hover:block"></i>
                                                <span class="block group-hover:hidden">Following</span>
                                                <span class="hidden group-hover:block">Unfollow</span>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('user.follow', $user)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" 
                                                    class="flex items-center gap-2 bg-blue-600 text-white px-6 py-2.5 rounded-full hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-user-plus"></i>
                                                <span>Follow</span>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Bio -->
                    <?php if($user->bio): ?>
                        <p class="mt-4 text-gray-700"><?php echo e($user->bio); ?></p>
                    <?php endif; ?>

                    <!-- Stats -->
                    <div class="flex items-center gap-6 mt-6">
                        <div class="text-center">
                            <span class="block font-bold text-gray-900"><?php echo e($user->articles_count); ?></span>
                            <span class="text-gray-600">Articles</span>
                        </div>
                        <a href="<?php echo e(route('user.followers', $user->username)); ?>" class="text-center hover:text-blue-600">
                            <span class="block font-bold text-gray-900"><?php echo e($user->followers_count); ?></span>
                            <span class="text-gray-600">Followers</span>
                        </a>
                        <a href="<?php echo e(route('user.following', $user->username)); ?>" class="text-center hover:text-blue-600">
                            <span class="block font-bold text-gray-900"><?php echo e($user->following_count); ?></span>
                            <span class="text-gray-600">Following</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- User's Articles -->
        <div class="space-y-6">
            <h2 class="text-2xl font-bold">Articles</h2>
            <?php if($articles->count() > 0): ?>
                <div class="flex flex-wrap gap-6">
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-lg shadow overflow-hidden w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                            <a href="<?php echo e(route('articles.show', $article)); ?>" class="block h-full">
                                <?php if($article->cover_image): ?>
                                    <div class="aspect-w-16 aspect-h-9">
                                        <img src="<?php echo e($article->cover_image); ?>" 
                                             alt="<?php echo e($article->title); ?>" 
                                             class="w-full object-cover">
                                    </div>
                                <?php endif; ?>
                                <div class="p-4 flex flex-col h-full">
                                    <div class="flex-1">
                                        <h3 class="font-bold text-lg mb-2 truncate"><?php echo e($article->title); ?></h3>
                                        <p class="text-gray-600 text-sm whitespace-pre-line"><?php echo e($article->description); ?></p>
                                    </div>
                                    <div class="flex items-center justify-between text-sm text-gray-500 mt-4">
                                        <span><?php echo e($article->created_at->format('M d, Y')); ?></span>
                                        <span><?php echo e($article->read_time ?? '5'); ?> min read</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <!-- Pagination -->
                <div class="mt-6">
                    <?php echo e($articles->links()); ?>

                </div>
            <?php else: ?>
                <p class="text-gray-600">No articles yet.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html> <?php /**PATH C:\project-rasya\blogging\resources\views/profile/show.blade.php ENDPATH**/ ?>