@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-2">
            <h1 class="text-2xl font-bold">Followers</h1>
            <span class="text-gray-500">·</span>
            <span class="text-gray-600">{{ count($followers) }}</span>
        </div>
        <a href="{{ route('profile.show', $user->username) }}" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 no-underline transition-colors">
            <i class="fas fa-arrow-left text-sm"></i>
            <span>Kembali ke Profil</span>
        </a>
    </div>

    <!-- Followers List -->
    <div class="space-y-4">
        @forelse($followers as $follower)
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <!-- Avatar with Online Status -->
                    <div class="relative">
                        @if($follower->avatar)
                            <img src="/avatars/{{ $follower->avatar }}" 
                                 alt="{{ $follower->username }}" 
                                 class="w-12 h-12 rounded-full object-cover ring-2 ring-white">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($follower->username) }}" 
                                 alt="{{ $follower->username }}" 
                                 class="w-12 h-12 rounded-full ring-2 ring-white">
                        @endif
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full ring-2 ring-white"></div>
                    </div>

                    <!-- User Info -->
                    <div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('profile.show', $follower->username) }}" 
                               class="font-medium hover:text-gray-600 no-underline transition-colors">
                                {{ $follower->username }}
                            </a>
                            @if($follower->role === 'verified')
                                <span class="text-blue-600">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center gap-4 mt-1 text-sm text-gray-500">
                            @if($follower->bio)
                                <p class="line-clamp-1">{{ $follower->bio }}</p>
                            @endif
                            <div class="flex items-center gap-2">
                                <i class="fas fa-newspaper text-xs"></i>
                                <span>{{ $follower->articles->count() }} articles</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Follow Button -->
                @auth
                    @if(auth()->user()->id !== $follower->id)
                        @if(auth()->user()->isFollowing($follower))
                            <form action="{{ route('user.unfollow', $follower) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="flex items-center gap-2 bg-gray-100 text-gray-800 px-6 py-2.5 rounded-full hover:bg-red-500 hover:text-white group transition-all">
                                    <i class="fas fa-user-check group-hover:hidden"></i>
                                    <i class="fas fa-user-times hidden group-hover:block"></i>
                                    <span class="block group-hover:hidden">Following</span>
                                    <span class="hidden group-hover:block">Unfollow</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('user.follow', $follower) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center gap-2 bg-blue-600 text-white px-6 py-2.5 rounded-full hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Follow</span>
                                </button>
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                <div class="flex flex-col items-center gap-3">
                    <i class="fas fa-user-friends text-4xl text-gray-400"></i>
                    <p class="text-gray-600">Belum ada followers.</p>
                    <a href="{{ route('stories.index') }}" 
                       class="text-blue-600 hover:text-blue-700 no-underline transition-colors">
                        Mulai menulis artikel untuk mendapatkan followers
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($followers->hasPages())
        <div class="mt-6">
            {{ $followers->links() }}
        </div>
    @endif
</div>

<style>
    a { text-decoration: none !important; }
</style>
@endsection 