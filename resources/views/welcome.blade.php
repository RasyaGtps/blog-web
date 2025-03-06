<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Medium Clone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f8f6f2] text-black font-['Georgia'] flex flex-col min-h-screen">
    <div class="bg-white w-full">
        @include('layouts.navigation')
    </div>
    
    <main class="flex justify-center items-center flex-col flex-grow px-4 py-20">
        <section class="hero max-w-[900px]">
            <h1 class="text-[85px] font-bold leading-[1] mb-8 whitespace-nowrap">Cerita & Ide Manusia</h1>
            <p class="text-2xl mb-8 text-center">Sebuah Tempat membaca, menulis, dan memperdalam pemahaman Anda</p>
        </section>
    </main>

    @include('layouts.footer')

    <div class="hidden fixed inset-0 bg-white/95 z-[1000] items-center justify-center" id="signUpModal">
        <div class="bg-white p-8 rounded shadow-lg w-full max-w-md mx-auto my-auto relative" data-aos="fade-up">
            <button class="absolute top-4 right-4 text-2xl text-[#242424] hover:text-gray-700" id="closeModal">&times;</button>
            <h2 class="text-2xl font-bold mb-4">Sign up with email</h2>
            <p class="text-gray-600 mb-6">Enter your details to create an account.</p>
            
            <form id="registerForm" class="space-y-4">
                <div>
                    <div class="hidden text-red-500 text-sm mb-2" id="nameError"></div>
                    <input type="text" name="name" placeholder="Full Name" class="w-full px-4 py-2 rounded border mb-4 focus:outline-none focus:border-gray-500">
                </div>

                <div>
                    <div class="hidden text-red-500 text-sm mb-2" id="usernameError"></div>
                    <input type="text" name="username" placeholder="Username" class="w-full px-4 py-2 rounded border mb-4 focus:outline-none focus:border-gray-500">
                </div>

                <div>
                    <div class="hidden text-red-500 text-sm mb-2" id="emailError"></div>
                    <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 rounded border mb-4 focus:outline-none focus:border-gray-500">
                </div>

                <div class="relative">
                    <div class="hidden text-red-500 text-sm mb-2" id="passwordError"></div>
                    <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 rounded border mb-4 focus:outline-none focus:border-gray-500">
                    <i class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 cursor-pointer password-toggle fas fa-eye"></i>
                </div>

                <div class="relative">
                    <div class="hidden text-red-500 text-sm mb-2" id="password_confirmationError"></div>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full px-4 py-2 rounded border mb-4 focus:outline-none focus:border-gray-500">
                    <i class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 cursor-pointer password-toggle fas fa-eye"></i>
                </div>

                <button type="submit" class="w-full bg-black text-white py-2 rounded-full hover:bg-[#242424] transition-colors">Create Account</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        const modal = document.getElementById('signUpModal');
        const closeModal = document.getElementById('closeModal');

        closeModal.addEventListener('click', function() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });

        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });

        const registerForm = document.getElementById('registerForm');
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            document.querySelectorAll('.error-message').forEach(el => {
                el.textContent = '';
                el.style.display = 'none';
            });

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Registration successful!');
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                    window.location.reload();
                } else {
                    Object.keys(result.errors || {}).forEach(key => {
                        const errorEl = document.getElementById(key + 'Error');
                        if (errorEl) {
                            errorEl.textContent = result.errors[key][0];
                            errorEl.style.display = 'block';
                        }
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred during registration. Please try again.');
            }
        });
    </script>
</body>
</html>
