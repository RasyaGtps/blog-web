<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        [x-cloak] { 
            display: none !important; 
        }
        ::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        * {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#1a1a1a]">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 bg-[#242424] shadow-lg w-64 transform transition-transform duration-200 ease-in-out" 
               x-data="{ open: true }" 
               :class="{'translate-x-0': open, '-translate-x-full': !open}">
            <!-- Logo -->
            <div class="flex items-center justify-between px-4 py-6 border-b border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-white">
                    ByRead
                </a>
                <button @click="open = !open" class="lg:hidden text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="py-4">
                <div class="px-4 mb-4">
                    <p class="text-xs uppercase text-gray-400 tracking-wider">MAIN</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#2f2f2f] {{ request()->routeIs('admin.dashboard') ? 'bg-[#2f2f2f] text-white' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('admin.users') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#2f2f2f] {{ request()->routeIs('admin.users') ? 'bg-[#2f2f2f] text-white' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Users</span>
                </a>
                <a href="{{ route('admin.articles') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#2f2f2f] {{ request()->routeIs('admin.articles') ? 'bg-[#2f2f2f] text-white' : '' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span class="ml-3">Articles</span>
                </a>

                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs uppercase text-gray-400 tracking-wider">CONTENT</p>
                </div>
                <a href="{{ route('admin.tags') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#2f2f2f] {{ request()->routeIs('admin.tags') ? 'bg-[#2f2f2f] text-white' : '' }}">
                    <i class="fas fa-tags w-5"></i>
                    <span class="ml-3">Tags</span>
                </a>

                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs uppercase text-gray-400 tracking-wider">REQUEST</p>
                </div>
                <a href="{{ route('admin.memberships') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#2f2f2f] {{ request()->routeIs('admin.memberships') ? 'bg-[#2f2f2f] text-white' : '' }} relative">
                    <div class="relative">
                        <i class="fas fa-user-shield w-5"></i>
                        @if($pendingRequests ?? 0 > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-medium w-5 h-5 flex items-center justify-center rounded-full">
                                {{ $pendingRequests }}
                            </span>
                        @endif
                    </div>
                    <span class="ml-3">Membership</span>
                </a>

                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs uppercase text-gray-400 tracking-wider">ACCOUNT</p>
                </div>
                <a href="{{ route('admin.profile') }}" 
                   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#2f2f2f] {{ request()->routeIs('admin.profile') ? 'bg-[#2f2f2f] text-white' : '' }}">
                    <i class="fas fa-user-circle w-5"></i>
                    <span class="ml-3">Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center px-6 py-3 text-gray-300 hover:bg-[#2f2f2f]">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="ml-3">Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="lg:pl-64">
            <!-- Top Navigation -->
            <nav class="bg-[#242424] shadow">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <button @click="open = !open" class="lg:hidden text-gray-400 hover:text-white">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <div class="flex items-center space-x-4">
                                <span class="text-gray-300">{{ Auth::user()->name }}</span>
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('avatars/' . Auth::user()->avatar) }}" 
                                         alt="{{ Auth::user()->username }}" 
                                         class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-[#2f2f2f] flex items-center justify-center text-sm font-semibold text-gray-300 uppercase">
                                        {{ Str::substr(Auth::user()->username, 0, 2) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="py-6">
                @if (session('success'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                        <div class="bg-green-900 border border-green-800 text-green-100 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                        <div class="bg-red-900 border border-red-800 text-red-100 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html> 