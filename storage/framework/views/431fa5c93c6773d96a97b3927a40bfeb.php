

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-white">Edit Article</h1>
            <a href="<?php echo e(route('admin.articles')); ?>" 
               class="flex items-center gap-2 text-gray-400 hover:text-white">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Articles</span>
            </a>
        </div>

        <form action="<?php echo e(route('admin.articles.update', $article)); ?>" 
              method="POST" 
              class="bg-[#242424] rounded-lg shadow-lg p-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label class="block text-gray-400 mb-2">Title</label>
                    <input type="text" 
                           name="title" 
                           value="<?php echo e(old('title', $article->title)); ?>"
                           required
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
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

                <!-- Description -->
                <div>
                    <label class="block text-gray-400 mb-2">Description</label>
                    <textarea name="description" 
                              rows="3"
                              required
                              class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo e(old('description', $article->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
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

                <!-- Content -->
                <div>
                    <label class="block text-gray-400 mb-2">Content</label>
                    <textarea name="content" 
                              rows="15"
                              required
                              class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo e(old('content', $article->content)); ?></textarea>
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

                <!-- Cover Image URL -->
                <div>
                    <label class="block text-gray-400 mb-2">Cover Image URL</label>
                    <input type="url" 
                           name="cover_image" 
                           value="<?php echo e(old('cover_image', $article->cover_image)); ?>"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php $__errorArgs = ['cover_image'];
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

                <!-- Tags -->
                <div>
                    <label class="block text-gray-400 mb-2">Tags</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-center space-x-2 bg-[#2f2f2f] rounded p-3 cursor-pointer hover:bg-[#383838]">
                            <input type="checkbox" 
                                   name="tags[]" 
                                   value="<?php echo e($tag->id); ?>"
                                   <?php if(in_array($tag->id, old('tags', $selectedTags))): echo 'checked'; endif; ?>
                                   class="rounded border-gray-600 text-blue-600 focus:ring-blue-500 bg-[#242424]">
                            <span class="text-gray-300"><?php echo e($tag->name); ?></span>
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php $__errorArgs = ['tags'];
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

                <!-- Status -->
                <div>
                    <label class="block text-gray-400 mb-2">Status</label>
                    <select name="status" 
                            required
                            class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="draft" <?php if(old('status', $article->status) === 'draft'): echo 'selected'; endif; ?>>Draft</option>
                        <option value="published" <?php if(old('status', $article->status) === 'published'): echo 'selected'; endif; ?>>Published</option>
                    </select>
                    <?php $__errorArgs = ['status'];
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

                <!-- Preview Current Cover -->
                <?php if($article->cover_image): ?>
                <div>
                    <label class="block text-gray-400 mb-2">Current Cover Image</label>
                    <img src="<?php echo e($article->cover_image); ?>" 
                         alt="<?php echo e($article->title); ?>" 
                         class="w-full max-w-xl rounded-lg shadow-lg">
                </div>
                <?php endif; ?>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="<?php echo e(route('admin.articles')); ?>"
                       class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Update Article
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project-rasya\blogging\resources\views/admin/articles/edit.blade.php ENDPATH**/ ?>