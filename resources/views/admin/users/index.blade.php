@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                <i class="fas fa-users text-gray-400"></i>
                Manajemen User
            </h1>
            <p class="text-gray-400 mt-1">
                <i class="fas fa-user-circle mr-2"></i>
                Total User: {{ $users->total() }}
            </p>
        </div>
        <a href="{{ route('admin.users.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
            <i class="fas fa-user-plus"></i>
            <span>Tambah User Baru</span>
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="bg-[#242424] rounded-lg shadow-lg p-6 mb-8">
        <form action="{{ route('admin.users') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="relative">
                <input type="text" 
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari user..." 
                       class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <div class="relative">
                <select name="role" 
                        onchange="this.form.submit()"
                        class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg pl-10 pr-4 py-2 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Role</option>
                    <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="verified" {{ request('role') === 'verified' ? 'selected' : '' }}>Verified</option>
                </select>
                <i class="fas fa-user-tag absolute left-3 top-3 text-gray-400"></i>
            </div>
            <div class="relative">
                <select name="sort" 
                        onchange="this.form.submit()"
                        class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg pl-10 pr-4 py-2 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="most_articles" {{ request('sort') === 'most_articles' ? 'selected' : '' }}>Artikel Terbanyak</option>
                    <option value="most_comments" {{ request('sort') === 'most_comments' ? 'selected' : '' }}>Komentar Terbanyak</option>
                </select>
                <i class="fas fa-sort absolute left-3 top-3 text-gray-400"></i>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-[#242424] rounded-lg shadow-lg overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="text-left p-4 text-gray-400 font-medium">User</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Role</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Membership</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Statistik</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Tanggal Daftar</th>
                    <th class="text-right p-4 text-gray-400 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($users as $user)
                <tr class="hover:bg-[#2f2f2f] transition-colors">
                    <td class="p-4">
                        <div class="flex items-center space-x-3">
                            @if($user->avatar)
                                <img src="{{ asset('avatars/' . $user->avatar) }}" 
                                     alt="{{ $user->username }}" 
                                     class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-[#1a1a1a] flex items-center justify-center text-sm font-semibold text-gray-300 uppercase">
                                    {{ Str::substr($user->username, 0, 2) }}
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-white">{{ $user->name }}</div>
                                <div class="text-sm text-gray-400">{{ '@' . $user->username }}</div>
                                <div class="text-sm text-gray-400">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        @if($user->role === 'admin')
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-900/20 text-yellow-400">
                                Admin
                            </span>
                        @elseif($user->role === 'verified')
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-900/20 text-green-400">
                                Verified
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-900/20 text-blue-400">
                                User
                            </span>
                        @endif
                    </td>
                    <td class="p-4">
                        @if($user->membership === 'premium')
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-900/20 text-yellow-400">
                                Premium
                            </span>
                        @elseif($user->membership === 'basic')
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-900/20 text-blue-400">
                                Basic
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-900/20 text-gray-400">
                                Free
                            </span>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="flex items-center space-x-4 text-sm text-gray-400">
                            <span class="flex items-center gap-1" title="Artikel">
                                <i class="far fa-newspaper"></i>
                                {{ $user->articles_count }}
                            </span>
                            <span class="flex items-center gap-1" title="Komentar">
                                <i class="far fa-comment"></i>
                                {{ $user->comments_count }}
                            </span>
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm text-gray-400">
                            <div>{{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y') }}</div>
                            <div class="text-xs">{{ \Carbon\Carbon::parse($user->created_at)->format('H:i') }} WIB</div>
                        </div>
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('admin.users.edit', $user) }}" 
                               class="text-gray-400 hover:text-blue-400 transition-colors"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-gray-400 hover:text-red-400 transition-colors"
                                            title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="text-gray-400 text-6xl mb-4">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="text-xl font-medium text-white mb-2">Tidak ada user</h3>
                            <p class="text-gray-400 mb-6">Belum ada user yang terdaftar</p>
                            <a href="{{ route('admin.users.create') }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition-colors">
                                <i class="fas fa-user-plus"></i>
                                <span>Tambah User Baru</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection 