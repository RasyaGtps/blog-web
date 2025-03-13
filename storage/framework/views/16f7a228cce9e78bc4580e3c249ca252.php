

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-2">
            <h1 class="text-2xl font-bold">Following</h1>
            <span class="text-gray-500">·</span>
            <span class="text-gray-600"><?php echo e(count($following)); ?></span>
        </div>
        <a href="<?php echo e(route('profile.show', $user->username)); ?>" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 no-underline transition-colors">
            <i class="fas fa-arrow-left text-sm"></i>
            <span>Kembali ke Profil</span>
        </a>
    </div>

    <!-- Following List -->
    <div class="space-y-4">
        <?php $__empty_1 = true; $__currentLoopData = $following; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $followed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <!-- Avatar with Online Status -->
                    <div class="relative">
                        <?php if($followed->avatar): ?>
                            <img src="/avatars/<?php echo e($followed->avatar); ?>" 
                                 alt="<?php echo e($followed->username); ?>" 
                                 class="w-12 h-12 rounded-full object-cover ring-2 ring-white">
                        <?php else: ?>
                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($followed->username)); ?>" 
                                 alt="<?php echo e($followed->username); ?>" 
                                 class="w-12 h-12 rounded-full ring-2 ring-white">
                        <?php endif; ?>
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full ring-2 ring-white"></div>
                    </div>

                    <!-- User Info -->
                    <div>
                        <div class="flex items-center gap-2">
                            <a href="<?php echo e(route('profile.show', $followed->username)); ?>" 
                               class="font-medium hover:text-blue-600 no-underline transition-colors">
                                <?php echo e($followed->username); ?>

                            </a>
                            <?php if($followed->role === 'verified'): ?>
                                <span class="text-blue-600">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="flex items-center gap-4 mt-1 text-sm text-gray-500">
                            <?php if($followed->bio): ?>
                                <p class="line-clamp-1"><?php echo e($followed->bio); ?></p>
                            <?php endif; ?>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-newspaper text-xs"></i>
                                <span><?php echo e($followed->articles->count()); ?> articles</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Follow Button -->
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->id !== $followed->id): ?>
                        <?php if(auth()->user()->isFollowing($followed)): ?>
                            <form action="<?php echo e(route('user.unfollow', $followed)); ?>" method="POST">
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
                            <form action="<?php echo e(route('user.follow', $followed)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" 
                                        class="flex items-center gap-2 bg-blue-600 text-white px-6 py-2.5 rounded-full hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Follow</span>
                                </button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                <div class="flex flex-col items-center gap-3">
                    <i class="fas fa-user-friends text-4xl text-gray-400"></i>
                    <p class="text-gray-600">Belum mengikuti siapapun.</p>
                    <a href="<?php echo e(route('stories.index')); ?>" 
                       class="text-blue-600 hover:text-blue-700 no-underline transition-colors">
                        Jelajahi artikel untuk menemukan penulis
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if($following->hasPages()): ?>
        <div class="mt-6">
            <?php echo e($following->links()); ?>

        </div>
    <?php endif; ?>
</div>

<style>
    a { text-decoration: none !important; }
</style>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project-rasya\blogging\resources\views/profile/following.blade.php ENDPATH**/ ?>