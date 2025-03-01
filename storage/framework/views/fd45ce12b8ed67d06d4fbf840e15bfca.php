<div class="comment-container pl-4" x-data="{ showReplyForm: false }">
    <!-- Comment Header -->
    <div class="flex items-center gap-2 mb-2">
        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($comment->user->name)); ?>" 
             alt="<?php echo e($comment->user->name); ?>" 
             class="w-6 h-6 rounded-full">
        <span class="font-medium"><?php echo e($comment->user->name); ?></span>
        <?php if($comment->user->id === $article->user_id): ?>
            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                <i class="fas fa-crown text-xs"></i>
                Author
            </span>
        <?php endif; ?>
        <?php if($comment->user->role === 'verified'): ?>
            <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                <i class="fas fa-check-circle text-xs"></i>
                Verified
            </span>
        <?php endif; ?>
        <span class="text-gray-500 text-sm"><?php echo e($comment->created_at->diffForHumans()); ?></span>
    </div>

    <!-- Comment Content -->
    <div class="pl-8">
        <p class="text-gray-800 mb-2"><?php echo e($comment->content); ?></p>
        
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
            <form action="<?php echo e(route('comments.store', $article)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="parent_id" value="<?php echo e($comment->id); ?>">
                <textarea name="content" 
                          class="w-full p-3 border border-gray-200 rounded-lg focus:border-gray-300 focus:ring-0 text-sm"
                          rows="3"
                          placeholder="What are your thoughts?"
                          required></textarea>
                <div class="flex justify-end gap-2 mt-2">
                    <button type="button" 
                            @click="showReplyForm = false"
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm bg-black text-white rounded-full hover:bg-gray-800">
                        Respond
                    </button>
                </div>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <!-- Nested Replies -->
    <?php if($comment->replies->count() > 0): ?>
        <div class="mt-4 border-l-2 border-gray-100">
            <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('articles.partials.comment', ['comment' => $reply], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div> <?php /**PATH C:\project-rasya\blogging\resources\views/articles/partials/comment.blade.php ENDPATH**/ ?>