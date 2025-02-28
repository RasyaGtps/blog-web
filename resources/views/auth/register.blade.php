<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up - ByRead</title>
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
                <h2 class="text-3xl font-bold">Sign up with email</h2>
                <p class="text-gray-600 mt-2">Enter your details to create an account.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5" id="registerForm">
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-user @error('name') text-red-500 @else text-gray-400 @enderror text-lg"></i>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" 
                            class="w-full pl-12 pr-4 py-4 rounded-full border @error('name') border-red-500 @else border-gray-200 @enderror focus:outline-none focus:border-gray-400" 
                            placeholder="Full Name">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm pl-4">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div class="space-y-2">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-at @error('username') text-red-500 @else text-gray-400 @enderror text-lg"></i>
                        </div>
                        <input type="text" name="username" value="{{ old('username') }}"
                            class="w-full pl-12 pr-4 py-4 rounded-full border @error('username') border-red-500 @else border-gray-200 @enderror focus:outline-none focus:border-gray-400"
                            placeholder="Username">
                    </div>
                    @error('username')
                        <p class="text-red-500 text-sm pl-4">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-envelope @error('email') text-red-500 @else text-gray-400 @enderror text-lg"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full pl-12 pr-4 py-4 rounded-full border @error('email') border-red-500 @else border-gray-200 @enderror focus:outline-none focus:border-gray-400"
                            placeholder="Email">
                    </div>
                    @error('email')
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
                            placeholder="Password">
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

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-lock @error('password') text-red-500 @else text-gray-400 @enderror text-lg"></i>
                        </div>
                        <input type="password" name="password_confirmation"
                            class="w-full pl-12 pr-12 py-4 rounded-full border @error('password') border-red-500 @else border-gray-200 @enderror focus:outline-none focus:border-gray-400"
                            placeholder="Confirm Password">
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 flex items-center pr-4">
                            <button type="button" class="password-toggle focus:outline-none">
                                <i class="fas fa-eye @error('password') text-red-500 @else text-gray-400 @enderror text-lg hover:text-gray-600"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-black text-white py-4 rounded-full text-lg font-medium hover:bg-[#242424] transition-colors mt-6">
                    Create Account
                </button>

                <div class="text-center text-sm text-gray-600 mt-6">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700">Sign in</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        document.querySelectorAll('.password-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.closest('.relative').querySelector('input');
                const icon = this.querySelector('i');
                const isError = input.classList.contains('border-red-500');
                
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
        });

        // Prevent double submission
        document.getElementById('registerForm').addEventListener('submit', function() {
            this.querySelector('button[type="submit"]').disabled = true;
        });
    </script>
</body>
</html>