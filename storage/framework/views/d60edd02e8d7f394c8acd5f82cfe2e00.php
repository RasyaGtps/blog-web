<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Chat dengan <?php echo e($user->name); ?> - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <!-- Chat Container -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Back Button and Status -->
        <div class="flex items-center justify-between mb-6">
            <a href="<?php echo e(route('chat.index')); ?>" 
               class="flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Chat</span>
            </a>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('user-online-status', ['user' => $user]);

$__html = app('livewire')->mount($__name, $__params, 'lw-502077898-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>

        <!-- User Info -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-6">
            <div class="flex items-center gap-4">
                <?php if($user->avatar): ?>
                    <img src="<?php echo e(asset('avatars/' . $user->avatar)); ?>" 
                         alt="<?php echo e($user->username); ?>" 
                         class="w-12 h-12 rounded-full object-cover">
                <?php else: ?>
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-semibold uppercase">
                        <?php echo e(Str::substr($user->username, 0, 2)); ?>

                    </div>
                <?php endif; ?>
                <div>
                    <h2 class="font-semibold text-lg"><?php echo e($user->name); ?></h2>
                    <p class="text-gray-600"><?php echo e('@' . $user->username); ?></p>
                </div>
            </div>
        </div>

        <!-- Chat Box with Shadow and Border -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('chat', ['userId' => $user->id]);

$__html = app('livewire')->mount($__name, $__params, $user->id, $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>

        <!-- Chat Info -->
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Pesan yang dikirim bersifat private dan terenkripsi</p>
            <p class="mt-1">Laporkan jika ada penyalahgunaan <i class="fas fa-flag text-red-500"></i></p>
        </div>
    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html> <?php /**PATH C:\project-rasya\blogging\resources\views/chat/show.blade.php ENDPATH**/ ?>