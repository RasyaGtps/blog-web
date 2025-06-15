<?php $__env->startSection('content'); ?>
<div class="max-w-[1200px] mx-auto px-4 py-8">
    <!-- Article Header -->
    <h1 class="text-4xl font-bold font-serif mb-4 leading-tight"><?php echo e($article->title); ?></h1>
    
    <!-- Article Description -->
    <p class="text-xl text-gray-600 mb-4 leading-relaxed text-justify">
        <?php echo e($article->description); ?>

    </p>
    <!-- Author Info & Article Meta -->
    <div class="flex items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <?php if($article->user->avatar): ?>
                <img src="/avatars/<?php echo e($article->user->avatar); ?>" 
                     alt="<?php echo e($article->user->username); ?>" 
                     class="w-12 h-12 rounded-full object-cover">
            <?php else: ?>
                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($article->user->username)); ?>" 
                     alt="<?php echo e($article->user->username); ?>" 
                     class="w-12 h-12 rounded-full">
            <?php endif; ?>
            <div>
                <div class="flex items-center gap-2">
                    <a href="<?php echo e(route('profile.show', $article->user->username)); ?>" class="font-medium hover:text-gray-600">
                        <?php echo e($article->user->username); ?>

                    </a>
                    <?php if($article->user->role === 'verified'): ?>
                        <span class="text-blue-600">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->id !== $article->user->id): ?>
                            <?php if(auth()->user()->isFollowing($article->user)): ?>
                                <form action="<?php echo e(route('user.unfollow', $article->user)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-green-600 hover:text-green-700 px-3 py-1 rounded-full border border-green-600 text-sm">
                                        Following
                                    </button>
                                </form>
                            <?php else: ?>
                                <form action="<?php echo e(route('user.follow', $article->user)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="text-green-600 hover:text-green-700 px-3 py-1 rounded-full border border-green-600 text-sm">
                                        Follow
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
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
    <div class="prose max-w-none mb-8">
        <div class="max-w-[1200px] text-lg">
            <?php $__currentLoopData = preg_split('/\n\s*\n/', $article->content); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(trim($paragraph)): ?>
                    <p class="mb-6 text-justify"><?php echo e($paragraph); ?></p>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Tags Below -->
    <?php if($article->tags->count() > 0): ?>
        <div class="flex flex-wrap gap-2 py-6 border-t border-gray-200">
            <?php $__currentLoopData = $article->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="#" class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-200 hover:bg-gray-300 transition-colors">
                    <span class="text-gray-600">#</span>
                    <span class="text-gray-800"><?php echo e($tag->name); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

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
        <h2 class="text-xl font-bold mb-8">Komentar (<?php echo e($article->comments->count()); ?>)</h2>

        <!-- Comment Form -->
        <?php if(auth()->guard()->check()): ?>
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-2">
                    <a href="<?php echo e(route('profile.show', auth()->user()->username)); ?>" class="flex items-center gap-2">
                        <?php if(auth()->user()->avatar): ?>
                            <img src="<?php echo e(asset('avatars/' . auth()->user()->avatar)); ?>" 
                                 alt="<?php echo e(auth()->user()->username); ?>" 
                                 class="w-8 h-8 rounded-full object-cover">
                        <?php else: ?>
                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->username)); ?>" 
                                 alt="<?php echo e(auth()->user()->username); ?>" 
                                 class="w-8 h-8 rounded-full">
                        <?php endif; ?>
                        <span class="font-medium hover:text-blue-600"><?php echo e(auth()->user()->username); ?></span>
                    </a>
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
                                  class="w-full p-3 bg-gray-100 rounded-lg border-0 focus:ring-0 text-base resize-none focus:bg-white transition-colors"
                                  rows="1"
                                  placeholder="Tulis komentar..."
                                  required></textarea>
                        <div class="flex justify-end mt-2">
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-blue-700">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-gray-50 rounded-lg p-4 text-center mb-8">
                <a href="<?php echo e(route('login')); ?>" class="text-blue-600 hover:underline">Sign in</a> to leave a response.
            </div>
        <?php endif; ?>

        <!-- Comments List -->
        <div class="space-y-6">
            <?php $__currentLoopData = $article->comments()->whereNull('parent_id')->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex gap-3" x-data="{ showReplyForm: false }">
                    <a href="<?php echo e(route('profile.show', $comment->user->username)); ?>" class="flex-shrink-0">
                        <?php if($comment->user->avatar): ?>
                            <img src="<?php echo e(asset('avatars/' . $comment->user->avatar)); ?>" 
                                 alt="<?php echo e($comment->user->username); ?>" 
                                 class="w-8 h-8 rounded-full object-cover">
                        <?php else: ?>
                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($comment->user->username)); ?>" 
                                 alt="<?php echo e($comment->user->username); ?>" 
                                 class="w-8 h-8 rounded-full">
                        <?php endif; ?>
                    </a>

                    <div class="flex-1">
                        <!-- Comment Header -->
                        <div class="flex items-center gap-2 mb-1">
                            <a href="<?php echo e(route('profile.show', $comment->user->username)); ?>" class="font-medium hover:text-blue-600">
                                <?php echo e($comment->user->username); ?>

                            </a>
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
                                    <a href="<?php echo e(route('profile.show', auth()->user()->username)); ?>" class="flex items-center gap-2">
                                        <?php if(auth()->user()->avatar): ?>
                                            <img src="<?php echo e(asset('avatars/' . auth()->user()->avatar)); ?>" 
                                                 alt="<?php echo e(auth()->user()->username); ?>" 
                                                 class="w-8 h-8 rounded-full object-cover">
                                        <?php else: ?>
                                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->username)); ?>" 
                                                 alt="<?php echo e(auth()->user()->username); ?>" 
                                                 class="w-8 h-8 rounded-full">
                                        <?php endif; ?>
                                        <span class="font-medium hover:text-blue-600"><?php echo e(auth()->user()->username); ?></span>
                                    </a>
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
                                        <input type="hidden" name="parent_id" value="<?php echo e($comment->id); ?>">
                                        <textarea name="content" 
                                                  class="w-full p-3 bg-gray-100 rounded-lg border-0 focus:ring-0 text-base resize-none focus:bg-white transition-colors"
                                                  rows="1"
                                                  placeholder="Tulis komentar..."
                                                  required></textarea>
                                        <div class="flex justify-end gap-2 mt-2">
                                            <button type="button" 
                                                    @click="showReplyForm = false"
                                                    class="text-gray-500 hover:text-gray-700 text-sm">
                                                Cancel
                                            </button>
                                            <button type="submit" 
                                                    class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-blue-700">
                                                Kirim
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
                                    <div class="flex gap-3 pl-8" x-data="{ showReplyForm: false }">
                                        <a href="<?php echo e(route('profile.show', $reply->user->username)); ?>" class="flex-shrink-0">
                                            <?php if($reply->user->avatar): ?>
                                                <img src="<?php echo e(asset('avatars/' . $reply->user->avatar)); ?>" 
                                                     alt="<?php echo e($reply->user->username); ?>" 
                                                     class="w-8 h-8 rounded-full object-cover">
                                            <?php else: ?>
                                                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($reply->user->username)); ?>" 
                                                     alt="<?php echo e($reply->user->username); ?>" 
                                                     class="w-8 h-8 rounded-full">
                                            <?php endif; ?>
                                        </a>
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <a href="<?php echo e(route('profile.show', $reply->user->username)); ?>" class="font-medium hover:text-blue-600">
                                                    <?php echo e($reply->user->username); ?>

                                                </a>
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
                                            
                                            <!-- Reply Actions -->
                                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                                <?php if(auth()->guard()->check()): ?>
                                                    <button @click="showReplyForm = !showReplyForm" class="hover:text-gray-700">
                                                        Reply
                                                    </button>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $reply)): ?>
                                                    <form action="<?php echo e(route('comments.destroy', $reply)); ?>" 
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

                                            <!-- Show Nested Replies -->
                                            <?php if($reply->replies->count() > 0): ?>
                                                <div class="mt-4 space-y-4">
                                                    <?php $__currentLoopData = $reply->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nestedReply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="flex gap-3 pl-8" x-data="{ showReplyForm: false }">
                                                            <a href="<?php echo e(route('profile.show', $nestedReply->user->username)); ?>" class="flex-shrink-0">
                                                                <?php if($nestedReply->user->avatar): ?>
                                                                    <img src="<?php echo e(asset('avatars/' . $nestedReply->user->avatar)); ?>" 
                                                                         alt="<?php echo e($nestedReply->user->username); ?>" 
                                                                         class="w-8 h-8 rounded-full object-cover">
                                                                <?php else: ?>
                                                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($nestedReply->user->username)); ?>" 
                                                                         alt="<?php echo e($nestedReply->user->username); ?>" 
                                                                         class="w-8 h-8 rounded-full">
                                                                <?php endif; ?>
                                                            </a>
                                                            <div class="flex-1">
                                                                <div class="flex items-center gap-2 mb-1">
                                                                    <a href="<?php echo e(route('profile.show', $nestedReply->user->username)); ?>" class="font-medium hover:text-blue-600">
                                                                        <?php echo e($nestedReply->user->username); ?>

                                                                    </a>
                                                                    <?php if($nestedReply->user->id === $article->user_id): ?>
                                                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                                                            <i class="fas fa-pen text-xs"></i>
                                                                            Author
                                                                        </span>
                                                                    <?php endif; ?>
                                                                    <?php if($nestedReply->user->role === 'verified'): ?>
                                                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                                                            <i class="fas fa-check-circle text-xs"></i>
                                                                            Verified
                                                                        </span>
                                                                    <?php endif; ?>
                                                                    <span class="text-gray-500 text-sm"><?php echo e($nestedReply->created_at->diffForHumans()); ?></span>
                                                                </div>
                                                                <div class="text-gray-800 mb-2"><?php echo e($nestedReply->content); ?></div>
                                                                
                                                                <!-- Nested Reply Actions -->
                                                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                                                    <?php if(auth()->guard()->check()): ?>
                                                                        <button @click="showReplyForm = !showReplyForm" class="hover:text-gray-700">
                                                                            Reply
                                                                        </button>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $nestedReply)): ?>
                                                                        <form action="<?php echo e(route('comments.destroy', $nestedReply)); ?>" 
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

                                                                <!-- Nested Reply Form -->
                                                                <?php if(auth()->guard()->check()): ?>
                                                                    <div x-show="showReplyForm" x-cloak class="mt-4">
                                                                        <div class="flex items-center gap-2 mb-2">
                                                                            <a href="<?php echo e(route('profile.show', auth()->user()->username)); ?>" class="flex items-center gap-2">
                                                                                <?php if(auth()->user()->avatar): ?>
                                                                                    <img src="<?php echo e(asset('avatars/' . auth()->user()->avatar)); ?>" 
                                                                                         alt="<?php echo e(auth()->user()->username); ?>" 
                                                                                         class="w-6 h-6 rounded-full object-cover">
                                                                                <?php else: ?>
                                                                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->username)); ?>" 
                                                                                         alt="<?php echo e(auth()->user()->username); ?>" 
                                                                                         class="w-6 h-6 rounded-full">
                                                                                <?php endif; ?>
                                                                                <span class="font-medium hover:text-blue-600"><?php echo e(auth()->user()->username); ?></span>
                                                                            </a>
                                                                            <?php if(auth()->user()->role === 'verified'): ?>
                                                                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                                                                    <i class="fas fa-check-circle text-xs"></i>
                                                                                    Verified
                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="pl-8">
                                                                            <form action="<?php echo e(route('comments.store', $article)); ?>" method="POST">
                                                                                <?php echo csrf_field(); ?>
                                                                                <input type="hidden" name="parent_id" value="<?php echo e($nestedReply->id); ?>">
                                                                                <textarea name="content" 
                                                                                          class="w-full p-3 bg-gray-100 rounded-lg border-0 focus:ring-0 text-base resize-none focus:bg-white transition-colors"
                                                                                          rows="1"
                                                                                          placeholder="Tulis balasan..."
                                                                                          required></textarea>
                                                                                <div class="flex justify-end gap-2 mt-2">
                                                                                    <button type="button" 
                                                                                            @click="showReplyForm = false"
                                                                                            class="text-gray-500 hover:text-gray-700 text-sm">
                                                                                        Batal
                                                                                    </button>
                                                                                    <button type="submit" 
                                                                                            class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-blue-700">
                                                                                        Kirim
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $nestedReply)): ?>
                                                                    <form action="<?php echo e(route('comments.destroy', $nestedReply)); ?>" 
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
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project-rasya\blogging\resources\views/articles/show.blade.php ENDPATH**/ ?>