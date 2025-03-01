<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="container max-w-[1200px] mx-auto px-4 py-12">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold mb-4">Choose Your Membership Plan</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Unlock premium features and support our community of writers with a ByRead membership.
            </p>
        </div>

        <!-- Pricing Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Free Plan -->
            <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold mb-2">Free</h3>
                    <div class="text-3xl font-bold mb-4">$0<span class="text-gray-500 text-base font-normal">/month</span></div>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Read 3 premium stories/month</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Basic commenting features</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Access to free stories</span>
                    </li>
                </ul>
                <button class="w-full py-3 px-4 border border-black text-black rounded-full hover:bg-black hover:text-white transition-colors">
                    Current Plan
                </button>
            </div>

            <!-- Basic Plan -->
            <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100 transform scale-105">
                <div class="text-center mb-6">
                    <div class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full inline-block mb-4">Popular</div>
                    <h3 class="text-xl font-bold mb-2">Basic</h3>
                    <div class="text-3xl font-bold mb-4">$5<span class="text-gray-500 text-base font-normal">/month</span></div>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Unlimited premium stories</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Advanced commenting features</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>No ads experience</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Support your favorite writers</span>
                    </li>
                </ul>
                <button class="w-full py-3 px-4 bg-black text-white rounded-full hover:bg-gray-800 transition-colors">
                    Upgrade Now
                </button>
            </div>

            <!-- Premium Plan -->
            <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold mb-2">Premium</h3>
                    <div class="text-3xl font-bold mb-4">$12<span class="text-gray-500 text-base font-normal">/month</span></div>
                </div>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>All Basic features</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Verified badge</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Priority support</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-green-500"></i>
                        <span>Early access to new features</span>
                    </li>
                </ul>
                <button class="w-full py-3 px-4 border border-black text-black rounded-full hover:bg-black hover:text-white transition-colors">
                    Go Premium
                </button>
            </div>
        </div>

        <!-- Features Section -->
        <div class="mt-24">
            <h2 class="text-3xl font-bold text-center mb-12">Why Choose ByRead Membership?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book-reader text-2xl text-blue-800"></i>
                    </div>
                    <h3 class="font-bold mb-2">Unlimited Reading</h3>
                    <p class="text-gray-600">Access all premium stories without any restrictions.</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl text-blue-800"></i>
                    </div>
                    <h3 class="font-bold mb-2">Support Writers</h3>
                    <p class="text-gray-600">Your membership directly supports our community of writers.</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-2xl text-blue-800"></i>
                    </div>
                    <h3 class="font-bold mb-2">Premium Features</h3>
                    <p class="text-gray-600">Get access to exclusive features and early updates.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html> <?php /**PATH C:\project-rasya\blogging\resources\views\membership\index.blade.php ENDPATH**/ ?>