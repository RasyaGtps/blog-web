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
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            z-index: 1000;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 4px;
            width: 100%;
            max-width: 400px;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .close-button {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #242424;
        }
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
        .form-input {
            @apply w-full px-4 py-2 rounded border mb-4 focus:outline-none focus:border-gray-500;
        }
        .error-message {
            @apply text-red-500 text-sm mb-2 hidden;
        }
    </style>
</head>
<body class="bg-[#f8f6f2] text-black font-['Georgia']">
    <div class="bg-white w-full">
        @include('layouts.navigation')
    </div>
    
    <main class="flex justify-center items-center flex-col h-[80vh] text-center px-4">
        <section class="hero max-w-[900px]">
            <h1 class="text-[85px] font-bold leading-[1] mb-8 whitespace-nowrap">
                Cerita & Ide Manusia
            </h1>
            <p class="text-2xl mb-8">
                Sebuah Tempat membaca, menulis, dan memperdalam pemahaman Anda
            </p>
        </section>
    </main>

    <!-- Sign Up Modal -->
    <div class="modal" id="signUpModal">
        <div class="modal-content mx-auto my-auto" data-aos="fade-up">
            <button class="close-button" id="closeModal">&times;</button>
            <h2 class="text-2xl font-bold mb-4">Sign up with email</h2>
            <p class="text-gray-600 mb-6">Enter your details to create an account.</p>
            
            <form id="registerForm" class="space-y-4">
                <div>
                    <div class="error-message" id="nameError"></div>
                    <input type="text" name="name" placeholder="Full Name" class="form-input">
                </div>

                <div>
                    <div class="error-message" id="usernameError"></div>
                    <input type="text" name="username" placeholder="Username" class="form-input">
                </div>

                <div>
                    <div class="error-message" id="emailError"></div>
                    <input type="email" name="email" placeholder="Email" class="form-input">
                </div>

                <div class="password-container">
                    <div class="error-message" id="passwordError"></div>
                    <input type="password" name="password" placeholder="Password" class="form-input">
                    <i class="password-toggle fas fa-eye"></i>
                </div>

                <div class="password-container">
                    <div class="error-message" id="password_confirmationError"></div>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-input">
                    <i class="password-toggle fas fa-eye"></i>
                </div>

                <button type="submit" class="w-full bg-black text-white py-2 rounded-full hover:bg-[#242424] transition-colors">
                    Create Account
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Modal handling
        const modal = document.getElementById('signUpModal');
        const closeModal = document.getElementById('closeModal');

        closeModal.addEventListener('click', function() {
            modal.classList.remove('active');
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });

        // Password toggle
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

        // Form submission
        const registerForm = document.getElementById('registerForm');
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Clear previous errors
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
                    modal.classList.remove('active');
                    window.location.reload();
                } else {
                    // Display validation errors
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
