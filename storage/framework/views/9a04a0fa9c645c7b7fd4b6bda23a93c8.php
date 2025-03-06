

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Profile Header -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex items-start space-x-6">
            <!-- Avatar -->
            <div class="flex-shrink-0">
                <?php if($user->avatar && file_exists(public_path('avatars/' . $user->avatar))): ?>
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
                            <?php if(auth()->user()->isFollowing($user)): ?>
                                <form action="<?php echo e(route('user.unfollow', $user)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="bg-gray-200 text-gray-800 px-6 py-2 rounded-full hover:bg-red-500 hover:text-white group">
                                        <span class="block group-hover:hidden">Following</span>
                                        <span class="hidden group-hover:block">Unfollow</span>
                                    </button>
                                </form>
                            <?php else: ?>
                                <form action="<?php echo e(route('user.follow', $user)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">
                                        Follow
                                    </button>
                                </form>
                            <?php endif; ?>
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
                    <a href="<?php echo e(route('user.followers', $user)); ?>" class="text-center hover:text-blue-600">
                        <span class="block font-bold text-gray-900"><?php echo e($user->followers_count); ?></span>
                        <span class="text-gray-600">Followers</span>
                    </a>
                    <a href="<?php echo e(route('user.following', $user)); ?>" class="text-center hover:text-blue-600">
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <a href="<?php echo e(route('articles.show', $article)); ?>" class="block">
                            <?php if($article->cover_image): ?>
                                <img src="<?php echo e($article->cover_image); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-48 object-cover">
                            <?php endif; ?>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2"><?php echo e($article->title); ?></h3>
                                <p class="text-gray-600 text-sm mb-4"><?php echo e(Str::limit($article->description, 100)); ?></p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
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
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project-rasya\blogging\resources\views/profile/show.blade.php ENDPATH**/ ?>