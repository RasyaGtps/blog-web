<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Article Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-4"><?php echo e($article->title); ?></h1>
        <div class="flex items-center text-gray-600 text-sm mb-6">
            <div class="flex items-center">
                <i class="fas fa-user mr-2"></i>
                <span><?php echo e($article->user->name); ?></span>
                <?php if($article->user->role === 'verified'): ?>
                    <span class="ml-2 bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                        <i class="fas fa-check-circle"></i>
                        Verified
                    </span>
                <?php endif; ?>
            </div>
            <div class="mx-4">•</div>
            <div class="flex items-center">
                <i class="fas fa-calendar mr-2"></i>
                <span><?php echo e($article->created_at->format('M d, Y')); ?></span>
            </div>
            <div class="mx-4">•</div>
            <div class="flex items-center">
                <i class="fas fa-eye mr-2"></i>
                <span><?php echo e(number_format($article->views)); ?> views</span>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="prose max-w-none mb-12">
        <?php echo $article->content; ?>

    </div>

    <!-- Comments Section -->
    <div class="mt-8 space-y-8">
        <h3 class="text-2xl font-bold flex items-center gap-2">
            <i class="far fa-comments"></i>
            Comments (<?php echo e($article->comments->count()); ?>)
        </h3>

        <!-- Comment Form -->
        <?php if(auth()->guard()->check()): ?>
        <form action="<?php echo e(route('comments.store', $article)); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>
            <textarea name="content" 
                      rows="3"
                      class="w-full rounded-lg border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200"
                      placeholder="Write a comment..."
                      required></textarea>
            <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <button type="submit" 
                    class="bg-black text-white px-6 py-2 rounded-full text-sm hover:bg-gray-800 transition-colors">
                Post Comment
            </button>
        </form>
        <?php else: ?>
        <div class="bg-gray-50 p-4 rounded-lg text-center">
            <a href="<?php echo e(route('login')); ?>" class="text-blue-600 hover:underline">Sign in</a> to join the discussion.
        </div>
        <?php endif; ?>

        <!-- Comments List -->
        <div class="space-y-6">
            <?php $__currentLoopData = $article->comments()->whereNull('parent_id')->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('articles.partials.comment', ['comment' => $comment], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project-rasya\blogging\resources\views\articles\show.blade.php ENDPATH**/ ?>