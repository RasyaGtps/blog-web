

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                <i class="fas fa-user-plus text-gray-400"></i>
                Tambah User Baru
            </h1>
            <p class="text-gray-400 mt-1">
                <i class="fas fa-info-circle mr-2"></i>
                Isi form di bawah untuk menambahkan user baru
            </p>
        </div>
        <a href="<?php echo e(route('admin.users')); ?>" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <div class="bg-[#242424] rounded-lg shadow-lg p-6">
        <form action="<?php echo e(route('admin.users.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Avatar -->
                <div class="col-span-2">
                    <label class="block text-gray-400 mb-2">Avatar</label>
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            <img id="avatar-preview" 
                                 class="h-16 w-16 object-cover rounded-full"
                                 src="<?php echo e(asset('images/default-avatar.png')); ?>" 
                                 alt="Avatar preview" />
                        </div>
                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input type="file" 
                                   name="avatar"
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-400
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100"
                                   onchange="document.getElementById('avatar-preview').src = window.URL.createObjectURL(this.files[0])" />
                        </label>
                    </div>
                    <?php $__errorArgs = ['avatar'];
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

                <!-- Name -->
                <div>
                    <label class="block text-gray-400 mb-2" for="name">Nama Lengkap</label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           value="<?php echo e(old('name')); ?>"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    <?php $__errorArgs = ['name'];
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

                <!-- Username -->
                <div>
                    <label class="block text-gray-400 mb-2" for="username">Username</label>
                    <input type="text" 
                           name="username" 
                           id="username"
                           value="<?php echo e(old('username')); ?>"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    <?php $__errorArgs = ['username'];
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

                <!-- Email -->
                <div>
                    <label class="block text-gray-400 mb-2" for="email">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           value="<?php echo e(old('email')); ?>"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    <?php $__errorArgs = ['email'];
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

                <!-- Password -->
                <div>
                    <label class="block text-gray-400 mb-2" for="password">Password</label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    <?php $__errorArgs = ['password'];
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

                <!-- Role -->
                <div class="col-span-2">
                    <label class="block text-gray-400 mb-2" for="role">Role</label>
                    <select name="role" 
                            id="role"
                            class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="user" <?php echo e(old('role') === 'user' ? 'selected' : ''); ?>>User</option>
                        <option value="admin" <?php echo e(old('role') === 'admin' ? 'selected' : ''); ?>>Admin</option>
                        <option value="verified" <?php echo e(old('role') === 'verified' ? 'selected' : ''); ?>>Verified</option>
                    </select>
                    <?php $__errorArgs = ['role'];
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
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="fas fa-save"></i>
                    <span>Simpan User</span>
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\project-rasya\blogging\resources\views/admin/users/create.blade.php ENDPATH**/ ?>