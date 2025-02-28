<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Login - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <!-- Main Content -->
    <div class="min-h-[calc(100vh-73px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-lg p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold">Welcome back!</h2>
                <p class="text-gray-600 mt-2">Enter your credentials to access your account.</p>
            </div>

            <!-- Session Status -->
            <?php if(session('status')): ?>
                <div class="mb-4 text-sm text-gray-600">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <!-- Success Message -->
            <?php if(session('success')): ?>
                <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-600">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-5" id="loginForm">
                <?php echo csrf_field(); ?>

                <!-- Email/Username -->
                <div class="space-y-2">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-user <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-red-500 <?php else: ?> text-gray-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> text-lg"></i>
                        </div>
                        <input type="text" name="login" value="<?php echo e(old('login')); ?>"
                            class="w-full pl-12 pr-4 py-4 rounded-full border <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:outline-none focus:border-gray-400"
                            placeholder="Email or Username"
                            required autofocus>
                    </div>
                    <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm pl-4"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-lock <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-red-500 <?php else: ?> text-gray-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> text-lg"></i>
                        </div>
                        <input type="password" name="password"
                            class="w-full pl-12 pr-12 py-4 rounded-full border <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-200 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> focus:outline-none focus:border-gray-400"
                            placeholder="Password"
                            required>
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 flex items-center pr-4">
                            <button type="button" class="password-toggle focus:outline-none">
                                <i class="fas fa-eye <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-red-500 <?php else: ?> text-gray-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> text-lg hover:text-gray-600"></i>
                            </button>
                        </div>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm pl-4"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-black shadow-sm focus:border-gray-300 focus:ring focus:ring-black focus:ring-opacity-20">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>

                    <?php if(Route::has('password.request')): ?>
                        <a class="text-sm text-green-600 hover:text-green-700" href="<?php echo e(route('password.request')); ?>">
                            Forgot your password?
                        </a>
                    <?php endif; ?>
                </div>

                <button type="submit" class="w-full bg-black text-white py-4 rounded-full text-lg font-medium hover:bg-[#242424] transition-colors mt-6">
                    Sign in
                </button>

                <div class="text-center text-sm text-gray-600 mt-6">
                    Don't have an account? 
                    <a href="<?php echo e(route('register')); ?>" class="text-green-600 hover:text-green-700">Sign up</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        // Password toggle functionality
        document.querySelector('.password-toggle').addEventListener('click', function() {
            const input = this.closest('.relative').querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Prevent double submission
        document.getElementById('loginForm').addEventListener('submit', function() {
            this.querySelector('button[type="submit"]').disabled = true;
        });
    </script>
</body>
</html>
<?php /**PATH C:\project-rasya\blogging\resources\views\auth\login.blade.php ENDPATH**/ ?>