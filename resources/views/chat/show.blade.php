<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <a href="{{ url()->previous() }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-sm text-gray-600">Online</span>
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