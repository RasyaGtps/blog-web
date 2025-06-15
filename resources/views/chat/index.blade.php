<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pesan - ByRead</title>
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
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold flex items-center gap-2">
                    <i class="fas fa-inbox text-blue-600"></i>
                    Pesan
                </h1>
                <p class="text-gray-600 mt-1">Kelola percakapan dengan penulis lain</p>
            </div>

            <!-- Chat List -->
            <div class="divide-y divide-gray-200">
                @forelse($chatUsers as $chatUser)
                    <a href="{{ route('chat.show', $chatUser) }}" 
                       class="flex items-center gap-4 p-4 hover:bg-gray-50 transition-colors">
                        <!-- User Avatar -->
                        @if($chatUser->avatar)
                            <img src="{{ asset('avatars/' . $chatUser->avatar) }}" 
                                 alt="{{ $chatUser->username }}" 
                                 class="w-12 h-12 rounded-full object-cover">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-semibold uppercase">
                                {{ Str::substr($chatUser->username, 0, 2) }}
                            </div>
                        @endif

                        <!-- User Info -->
                        <div class="flex-grow">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold">{{ $chatUser->name }}</h3>
                                @livewire('user-online-status', ['user' => $chatUser])
                            </div>
                            <p class="text-sm text-gray-600">{{ '@' . $chatUser->username }}</p>
                        </div>

                        <i class="fas fa-chevron-right text-gray-400"></i>
                    </a>
                @empty
                    <div class="p-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-4"></i>
                        <p>Belum ada percakapan</p>
                        <p class="text-sm mt-2">Mulai chat dengan mengunjungi profil penulis</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-6 bg-blue-50 text-blue-800 p-4 rounded-lg text-sm">
            <div class="flex items-start gap-3">
                <i class="fas fa-info-circle mt-1"></i>
                <div>
                    <p class="font-semibold">Tentang Fitur Chat</p>
                    <ul class="mt-2 space-y-1 list-disc list-inside text-blue-700">
                        <li>Chat hanya tersedia untuk pengguna terverifikasi</li>
                        <li>Pesan bersifat private dan terenkripsi</li>
                        <li>Laporkan jika ada penyalahgunaan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>

</html> 