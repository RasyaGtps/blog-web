<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Verifikasi OTP - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">
        <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md sm:rounded-lg">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900">Verifikasi Email</h2>
                <p class="mt-2 text-gray-600 text-sm">
                    Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi email Anda dengan memasukkan kode OTP yang telah kami kirim ke alamat email Anda.
                </p>
            </div>

            <?php if(session('success')): ?>
                <div class="mt-4 p-4 bg-green-50 rounded-lg">
                    <p class="text-sm font-medium text-green-800">
                        <?php echo e(session('success')); ?>

                    </p>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="mt-4 p-4 bg-red-50 rounded-lg">
                    <p class="text-sm font-medium text-red-800">
                        <?php echo e(session('error')); ?>

                    </p>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('verify.otp')); ?>" class="mt-6">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode OTP</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="otp" 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Masukkan 6 digit kode OTP"
                               maxlength="6"
                               required 
                               autofocus
                               autocomplete="off">
                    </div>
                    <?php $__errorArgs = ['otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mt-4">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        VERIFIKASI
                    </button>
                </div>
            </form>

            <div class="mt-4 text-center">
                <form method="POST" action="<?php echo e(route('resend.otp')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" 
                            id="resendButton"
                            class="text-sm text-gray-500 hover:text-gray-700 focus:outline-none">
                        <span id="resendText">Tunggu 30 detik</span>
                    </button>
                </form>
            </div>

            <div class="mt-4 text-center text-sm text-gray-500">
                <i class="fas fa-clock text-gray-400 mr-2"></i>
                Kode OTP akan kadaluarsa dalam 5 menit
            </div>
        </div>
    </div>

    <style>
        body {
            overflow: hidden;
        }
        .min-h-screen {
            height: 100vh;
            padding: 0;
        }
    </style>

    <script>
        let cooldown = 30;
        let timer = null;
        const resendButton = document.getElementById('resendButton');
        const resendText = document.getElementById('resendText');

        function startCooldown() {
            cooldown = 30;
            resendButton.disabled = true;
            resendButton.style.opacity = '0.5';
            resendButton.style.cursor = 'not-allowed';

            timer = setInterval(() => {
                cooldown--;
                resendText.textContent = `Tunggu ${cooldown} detik`;

                if (cooldown <= 0) {
                    clearInterval(timer);
                    resendButton.disabled = false;
                    resendButton.style.opacity = '1';
                    resendButton.style.cursor = 'pointer';
                    resendText.textContent = 'Kirim ulang kode OTP';
                }
            }, 1000);
        }

        // Start cooldown when page loads
        startCooldown();

        // Handle form submit for resend
        resendButton.closest('form').addEventListener('submit', function(e) {
            if (cooldown > 0) {
                e.preventDefault();
                return;
            }
            startCooldown();
        });

        // Hanya memperbolehkan input angka
        document.querySelector('input[name="otp"]').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html> <?php /**PATH C:\project-rasya\blogging\resources\views/auth/verify-otp.blade.php ENDPATH**/ ?>