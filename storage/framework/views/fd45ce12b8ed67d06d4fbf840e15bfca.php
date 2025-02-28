<div class="comment-container" style="margin-left: <?php echo e($comment->level * 1); ?>rem; border-left: 2px solid #e5e7eb; padding-left: 0.5rem;">
    <div class="bg-white rounded-lg p-4 shadow-sm">
        <!-- Comment Header -->
        <div class="flex justify-between items-start mb-2">
            <div class="flex items-center gap-2">
                <i class="fas fa-user-circle text-gray-400"></i>
                <span class="font-medium"><?php echo e($comment->user->name); ?></span>
                <span class="text-gray-500 text-sm">
                    <?php echo e($comment->created_at->diffForHumans()); ?>

                </span>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $comment)): ?>
            <form action="<?php echo e(route('comments.destroy', $comment)); ?>" 
                  method="POST" 
                  class="inline"
                  onsubmit="return confirm('Delete this comment?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
            <?php endif; ?>
        </div>

        <!-- Comment Content -->
        <p class="text-gray-700 mb-3"><?php echo e($comment->content); ?></p>

        <!-- Reply Button & Form -->
        <?php if(auth()->guard()->check()): ?>
        <div x-data="{ showReplyForm: false }">
            <button @click="showReplyForm = !showReplyForm" 
                    class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
                <i class="fas fa-reply"></i>
                Reply
            </button>

            <form x-show="showReplyForm" 
                  x-cloak 
                  action="<?php echo e(route('comments.store', $article)); ?>" 
                  method="POST" 
                  class="mt-3 space-y-3">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="parent_id" value="<?php echo e($comment->id); ?>">
                <textarea name="content" 
                          rows="2"
                          class="w-full rounded-lg border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 text-sm"
                          placeholder="Write a reply..."
                          required></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" 
                            @click="showReplyForm = false"
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-black text-white px-4 py-2 rounded-full text-sm hover:bg-gray-800">
                        Reply
                    </button>
                </div>
            </form>
        </div>
        <?php endif; ?>

        <!-- Nested Replies -->
        <?php if($comment->replies->count() > 0): ?>
            <div class="mt-4 space-y-4">
                <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('articles.partials.comment', ['comment' => $reply], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div> <?php /**PATH C:\project-rasya\blogging\resources\views/articles/partials/comment.blade.php ENDPATH**/ ?>