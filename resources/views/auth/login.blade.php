<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    @vite('resources/css/app.css')
</head>
<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full">
        @include('layouts.navigation')
    </div>

    <!-- Main Content -->
    <div class="min-h-[calc(100vh-73px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-lg p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold">Welcome back!</h2>
                <p class="text-gray-600 mt-2">Enter your credentials to access your account.</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-gray-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5" id="loginForm">
                @csrf

                <!-- Email/Username -->
                <div class="space-y-2">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-user @error('login') text-red-500 @else text-gray-400 @enderror text-lg"></i>
                        </div>
                        <input type="text" name="login" value="{{ old('login') }}"
                            class="w-full pl-12 pr-4 py-4 rounded-full border @error('login') border-red-500 @else border-gray-200 @enderror focus:outline-none focus:border-gray-400"
                            placeholder="Email or Username"
                            required autofocus>
                    </div>
                    @error('login')
                        <p class="text-red-500 text-sm pl-4">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-lock @error('password') text-red-500 @else text-gray-400 @enderror text-lg"></i>
                        </div>
                        <input type="password" name="password"
                            class="w-full pl-12 pr-12 py-4 rounded-full border @error('password') border-red-500 @else border-gray-200 @enderror focus:outline-none focus:border-gray-400"
                            placeholder="Password"
                            required>
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 flex items-center pr-4">
                            <button type="button" class="password-toggle focus:outline-none">
                                <i class="fas fa-eye @error('password') text-red-500 @else text-gray-400 @enderror text-lg hover:text-gray-600"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm pl-4">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-black shadow-sm focus:border-gray-300 focus:ring focus:ring-black focus:ring-opacity-20">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-green-600 hover:text-green-700" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-black text-white py-4 rounded-full text-lg font-medium hover:bg-[#242424] transition-colors mt-6">
                    Sign in
                </button>

                <div class="text-center text-sm text-gray-600 mt-6">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700">Sign up</a>
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