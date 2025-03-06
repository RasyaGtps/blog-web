

<?php $__env->startSection('content'); ?>
<div class="container max-w-4xl mx-auto px-4 py-8">
    <?php if(session('success')): ?>
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2" role="alert">
            <i class="fas fa-check-circle"></i>
            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center gap-2" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <span class="block sm:inline"><?php echo e(session('error')); ?></span>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl shadow-lg p-8 space-y-10">
        <!-- Header -->
        <div class="border-b border-gray-200 pb-6">
            <h1 class="text-2xl font-bold flex items-center gap-2">
                <i class="fas fa-user-circle text-blue-600"></i>
                Profile Settings
            </h1>
            <p class="text-gray-600 mt-1">Manage your account settings and profile information</p>
        </div>

        <!-- Profile Picture Section -->
        <div>
            <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
                <i class="fas fa-camera text-blue-600"></i>
                Profile Picture
            </h2>
            <div class="flex items-start space-x-6">
                <div class="relative group">
                    <?php if(Auth::user()->avatar && file_exists(public_path('avatars/' . Auth::user()->avatar))): ?>
                        <img src="<?php echo e(asset('avatars/' . Auth::user()->avatar)); ?>" 
                             alt="<?php echo e(Auth::user()->username); ?>" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 group-hover:border-blue-400 transition-colors">
                    <?php else: ?>
                        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-2xl font-semibold text-gray-600 uppercase group-hover:bg-gray-300 transition-colors">
                            <?php echo e(Str::substr(Auth::user()->username, 0, 2)); ?>

                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col">
                    <form action="<?php echo e(route('profile.updateAvatar')); ?>" method="POST" enctype="multipart/form-data" class="space-y-3">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <input type="file" 
                               id="avatar" 
                               name="avatar" 
                               class="hidden" 
                               accept="image/*"
                               onchange="document.getElementById('uploadBtn').classList.remove('hidden')">
                        <div>
                            <button type="button" 
                                    onclick="document.getElementById('avatar').click()" 
                                    class="flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
                                <i class="fas fa-upload"></i>
                                Upload a new avatar
                            </button>
                            <p class="text-sm text-gray-500 mt-1 flex items-center gap-1">
                                <i class="fas fa-info-circle"></i>
                                JPG, PNG, GIF up to 2MB
                            </p>
                        </div>
                        <button id="uploadBtn" 
                                type="submit" 
                                class="hidden bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
            <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo e($message); ?>

                </p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Profile Information -->
        <form action="<?php echo e(route('profile.update')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                    <i class="fas fa-user text-blue-600"></i>
                    Name
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="<?php echo e(old('name', Auth::user()->name)); ?>"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                    <i class="fas fa-at text-blue-600"></i>
                    Username
                </label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       value="<?php echo e(old('username', Auth::user()->username)); ?>"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                    <i class="fas fa-envelope text-blue-600"></i>
                    Email
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="<?php echo e(old('email', Auth::user()->email)); ?>"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                    <i class="fas fa-book text-blue-600"></i>
                    Bio
                </label>
                <textarea id="bio" 
                          name="bio" 
                          rows="3"
                          class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"><?php echo e(old('bio', Auth::user()->bio)); ?></textarea>
                <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-200">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project-rasya\blogging\resources\views/settings/profile.blade.php ENDPATH**/ ?>