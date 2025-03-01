<?php $__env->startSection('content'); ?>
<div class="max-w-[1200px] mx-auto px-4 py-8">
    <!-- Article Header -->
    <h1 class="text-4xl font-bold font-serif mb-4 leading-tight"><?php echo e($article->title); ?></h1>
    
    <!-- Article Description -->
    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
        <?php echo e($article->description); ?>

    </p>

    <!-- Author Info & Article Meta -->
    <div class="flex items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($article->user->username)); ?>" 
                 alt="<?php echo e($article->user->username); ?>" 
                 class="w-12 h-12 rounded-full">
            <div>
                <div class="flex items-center gap-2">
                    <a href="#" class="font-medium hover:text-gray-600"><?php echo e($article->user->username); ?></a>
                    <?php if($article->user->role === 'verified'): ?>
                        <span class="text-blue-600">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    <?php endif; ?>
                    <button class="text-green-600 hover:text-green-700 px-3 py-1 rounded-full border border-green-600 text-sm">
                        Follow
                    </button>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mt-1">
                    <span><?php echo e($article->read_time ?? '5'); ?> min read</span>
                    <span>·</span>
                    <span><?php echo e($article->created_at->format('M d, Y')); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Stats -->
    <div class="flex items-center gap-6 border-b border-gray-200 pb-8 mb-8 text-sm text-gray-500">
        <div class="flex items-center gap-2">
            <i class="far fa-eye"></i>
            <span><?php echo e(number_format($article->views)); ?> views</span>
        </div>
        <div class="flex items-center gap-2">
            <i class="far fa-comment"></i>
            <span><?php echo e($article->comments->count()); ?> comments</span>
        </div>
    </div>

    <!-- Article Content -->
    <div class="prose max-w-none mb-12">
        <?php echo $article->content; ?>

    </div>

    <!-- Article Stats Bottom -->
    <div class="flex items-center gap-6 py-4 border-t border-gray-200 text-gray-500">
        <div class="flex items-center gap-2">
            <i class="far fa-eye"></i>
            <span><?php echo e(number_format($article->views)); ?></span>
        </div>
        <div class="flex items-center gap-2">
            <i class="far fa-comment"></i>
            <span><?php echo e($article->comments->count()); ?></span>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="mt-12">
        <h2 class="text-xl font-bold mb-8">Responses (<?php echo e($article->comments->count()); ?>)</h2>

        <!-- Comment Form -->
        <?php if(auth()->guard()->check()): ?>
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-2">
                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name)); ?>" 
                         alt="<?php echo e(auth()->user()->name); ?>" 
                         class="w-8 h-8 rounded-full">
                    <span class="font-medium"><?php echo e(auth()->user()->name); ?></span>
                    <?php if(auth()->user()->role === 'verified'): ?>
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                            <i class="fas fa-check-circle text-xs"></i>
                            Verified
                        </span>
                    <?php endif; ?>
                </div>
                <div class="pl-10">
                    <form action="<?php echo e(route('comments.store', $article)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <textarea name="content" 
                                  class="w-full p-3 bg-gray-50 rounded-lg border-0 focus:ring-0 text-sm"
                                  rows="3"
                                  placeholder="What are your thoughts?"
                                  required></textarea>
                        <div class="flex justify-end mt-2">
                            <button type="submit" 
                                    class="bg-green-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-green-700">
                                Respond
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-gray-50 rounded-lg p-4 text-center mb-8">
                <a href="<?php echo e(route('login')); ?>" class="text-green-600 hover:underline">Sign in</a> to leave a response.
            </div>
        <?php endif; ?>

        <!-- Comments List -->
        <div class="space-y-6">
            <?php $__currentLoopData = $article->comments()->whereNull('parent_id')->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex gap-3" x-data="{ showReplyForm: false }">
                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($comment->user->name)); ?>" 
                         alt="<?php echo e($comment->user->name); ?>" 
                         class="w-8 h-8 rounded-full">
                    <div class="flex-1">
                        <!-- Comment Header -->
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-medium"><?php echo e($comment->user->name); ?></span>
                            <?php if($comment->user->id === $article->user_id): ?>
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fas fa-pen text-xs"></i>
                                    Author
                                </span>
                            <?php endif; ?>
                            <?php if($comment->user->role === 'verified'): ?>
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fas fa-check-circle text-xs"></i>
                                    Verified
                                </span>
                            <?php endif; ?>
                            <span class="text-gray-500 text-sm"><?php echo e($comment->created_at->diffForHumans()); ?></span>
                        </div>

                        <!-- Comment Content -->
                        <div class="text-gray-800 mb-2"><?php echo e($comment->content); ?></div>

                        <!-- Comment Actions -->
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <button @click="showReplyForm = !showReplyForm" class="hover:text-gray-700">
                                Reply
                            </button>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $comment)): ?>
                                <form action="<?php echo e(route('comments.destroy', $comment)); ?>" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Delete this comment?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="hover:text-red-500">
                                        Delete
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <!-- Reply Form -->
                        <?php if(auth()->guard()->check()): ?>
                            <div x-show="showReplyForm" x-cloak class="mt-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name)); ?>" 
                                         alt="<?php echo e(auth()->user()->name); ?>" 
                                         class="w-8 h-8 rounded-full">
                                    <span class="font-medium"><?php echo e(auth()->user()->name); ?></span>
                                    <?php if(auth()->user()->role === 'verified'): ?>
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                            <i class="fas fa-check-circle text-xs"></i>
                                            Verified
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="pl-10">
                                    <form action="<?php echo e(route('comments.store', $article)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="parent_id" value="<?php echo e($comment->id); ?>">
                                        <textarea name="content" 
                                                  class="w-full p-3 bg-gray-50 rounded-lg border-0 focus:ring-0 text-sm"
                                                  rows="3"
                                                  placeholder="What are your thoughts?"
                                                  required></textarea>
                                        <div class="flex justify-end gap-2 mt-2">
                                            <button type="button" 
                                                    @click="showReplyForm = false"
                                                    class="text-gray-500 hover:text-gray-700 text-sm">
                                                Cancel
                                            </button>
                                            <button type="submit" 
                                                    class="bg-green-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-green-700">
                                                Respond
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Nested Replies -->
                        <?php if($comment->replies->count() > 0): ?>
                            <div class="mt-4 space-y-4">
                                <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex gap-3 pl-8">
                                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($reply->user->name)); ?>" 
                                             alt="<?php echo e($reply->user->name); ?>" 
                                             class="w-8 h-8 rounded-full">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-medium"><?php echo e($reply->user->name); ?></span>
                                                <?php if($reply->user->id === $article->user_id): ?>
                                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                                        <i class="fas fa-pen text-xs"></i>
                                                        Author
                                                    </span>
                                                <?php endif; ?>
                                                <?php if($reply->user->role === 'verified'): ?>
                                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                                        <i class="fas fa-check-circle text-xs"></i>
                                                        Verified
                                                    </span>
                                                <?php endif; ?>
                                                <span class="text-gray-500 text-sm"><?php echo e($reply->created_at->diffForHumans()); ?></span>
                                            </div>
                                            <div class="text-gray-800 mb-2"><?php echo e($reply->content); ?></div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $reply)): ?>
                                                <form action="<?php echo e(route('comments.destroy', $reply)); ?>" 
                                                      method="POST" 
                                                      class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="text-sm text-gray-500 hover:text-red-500">
                                                        Delete
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project-rasya\blogging\resources\views/articles/show.blade.php ENDPATH**/ ?>