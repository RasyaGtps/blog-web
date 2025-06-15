<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat dengan {{ $user->name }} - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        @include('layouts.navigation')
    </div>

    <!-- Chat Container -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Back Button and Status -->
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('chat.index') }}" 
               class="flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Chat</span>
            </a>
            @livewire('user-online-status', ['user' => $user])
        </div>

        <!-- User Info -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-6">
            <div class="flex items-center gap-4">
                @if($user->avatar)
                    <img src="{{ asset('avatars/' . $user->avatar) }}" 
                         alt="{{ $user->username }}" 
                         class="w-12 h-12 rounded-full object-cover">
                @else
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-semibold uppercase">
                        {{ Str::substr($user->username, 0, 2) }}
                    </div>
                @endif
                <div>
                    <h2 class="font-semibold text-lg">{{ $user->name }}</h2>
                    <p class="text-gray-600">{{ '@' . $user->username }}</p>
                </div>
            </div>
        </div>

        <!-- Chat Box with Shadow and Border -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            @livewire('chat', ['userId' => $user->id], key($user->id))
        </div>

        <!-- Chat Info -->
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>Pesan yang dikirim bersifat private dan terenkripsi</p>
            <p class="mt-1">Laporkan jika ada penyalahgunaan <i class="fas fa-flag text-red-500"></i></p>
        </div>
    </div>

    @livewireScripts
</body>

</html> 