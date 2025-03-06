<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-6">Edit Article</h1>

        <form action="<?php echo e(route('articles.update', $article)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" id="title" 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400"
                    value="<?php echo e(old('title', $article->title)); ?>" required>
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea name="content" id="content" rows="10" 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400"
                    required><?php echo e(old('content', $article->content)); ?></textarea>
                <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" 
                    class="bg-black text-white px-6 py-2.5 rounded-full text-sm hover:bg-[#242424] transition-colors">
                    Update Article
                </button>

                <a href="<?php echo e(route('articles.show', $article)); ?>" 
                    class="text-gray-600 hover:text-gray-800 transition-colors">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Separate delete form -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <form action="<?php echo e(route('articles.destroy', $article)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" 
                    class="w-full bg-red-500 text-white px-6 py-2.5 rounded-full text-sm hover:bg-red-600 transition-colors"
                    onclick="return confirm('Are you sure you want to delete this article?')">
                    Delete Article
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-resize textarea
    const textarea = document.querySelector('textarea');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // Prevent accidental navigation
    window.onbeforeunload = function() {
        if (document.querySelector('form').querySelector('[name="title"]').value !== '<?php echo e($article->title); ?>' || 
            document.querySelector('form').querySelector('[name="content"]').value !== '<?php echo e($article->content); ?>') {
            return "You have unsaved changes. Are you sure you want to leave?";
        }
    };
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project-rasya\blogging\resources\views/articles/edit.blade.php ENDPATH**/ ?>