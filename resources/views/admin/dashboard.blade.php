@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-white">Admin Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-[#242424] rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Users</p>
                    <h2 class="text-3xl font-bold text-white">{{ number_format($totalUsers) }}</h2>
                </div>
                <div class="bg-blue-900/20 p-3 rounded-full">
                    <i class="fas fa-users text-blue-400 text-xl"></i>
                </div>
            </div>
            <p class="text-green-400 text-sm mt-2">
                <i class="fas fa-arrow-up"></i>
                {{ $newUsersToday }} new today
            </p>
        </div>

        <!-- Total Articles -->
        <div class="bg-[#242424] rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Articles</p>
                    <h2 class="text-3xl font-bold text-white">{{ number_format($totalArticles) }}</h2>
                </div>
                <div class="bg-green-900/20 p-3 rounded-full">
                    <i class="fas fa-newspaper text-green-400 text-xl"></i>
                </div>
            </div>
            <p class="text-green-400 text-sm mt-2">
                <i class="fas fa-arrow-up"></i>
                {{ $newArticlesToday }} new today
            </p>
        </div>

        <!-- User Roles -->
        <div class="bg-[#242424] rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-gray-400 text-sm">User Roles</p>
                <div class="bg-purple-900/20 p-3 rounded-full">
                    <i class="fas fa-user-shield text-purple-400 text-xl"></i>
                </div>
            </div>
            @foreach($userRoles as $role)
                <div class="flex items-center justify-between mb-2">
                    <span class="capitalize text-gray-300">{{ $role->role }}</span>
                    <span class="font-semibold text-white">{{ number_format($role->count) }}</span>
                </div>
            @endforeach
        </div>

        <!-- Memberships -->
        <div class="bg-[#242424] rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-gray-400 text-sm">Memberships</p>
                <div class="bg-yellow-900/20 p-3 rounded-full">
                    <i class="fas fa-crown text-yellow-400 text-xl"></i>
                </div>
            </div>
            @foreach($memberships as $membership)
                <div class="flex items-center justify-between mb-2">
                    <span class="capitalize text-gray-300">{{ $membership->membership }}</span>
                    <span class="font-semibold text-white">{{ number_format($membership->count) }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Latest Users -->
        <div class="bg-[#242424] rounded-lg shadow">
            <div class="p-6 border-b border-gray-700">
                <h2 class="text-xl font-semibold text-white">Latest Users</h2>
            </div>
            <div class="divide-y divide-gray-700">
                @foreach($latestUsers as $user)
                    <div class="p-6 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            @if($user->avatar)
                                <img src="{{ asset('avatars/' . $user->avatar) }}" 
                                     alt="{{ $user->username }}" 
                                     class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-[#2f2f2f] flex items-center justify-center text-sm font-semibold text-gray-300 uppercase">
                                    {{ Str::substr($user->username, 0, 2) }}
                                </div>
                            @endif
                            <div>
                                <h3 class="font-medium text-white">{{ $user->name }}</h3>
                                <p class="text-gray-400 text-sm">{{ '@' . $user->username }}</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-400">
                            {{ $user->created_at->diffForHumans() }}
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="p-6 border-t border-gray-700">
                <a href="{{ route('admin.users') }}" class="text-blue-400 hover:text-blue-300 font-medium">
                    View all users
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <!-- Latest Articles -->
        <div class="bg-[#242424] rounded-lg shadow">
            <div class="p-6 border-b border-gray-700">
                <h2 class="text-xl font-semibold text-white">Latest Articles</h2>
            </div>
            <div class="divide-y divide-gray-700">
                @foreach($latestArticles as $article)
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-3">
                                @if($article->user->avatar)
                                    <img src="{{ asset('avatars/' . $article->user->avatar) }}" 
                                         alt="{{ $article->user->username }}" 
                                         class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-[#2f2f2f] flex items-center justify-center text-sm font-semibold text-gray-300 uppercase">
                                        {{ Str::substr($article->user->username, 0, 2) }}
                                    </div>
                                @endif
                                <span class="text-sm text-gray-300">{{ $article->user->username }}</span>
                            </div>
                            <span class="text-sm text-gray-400">
                                {{ $article->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <h3 class="font-medium text-white mb-1">{{ $article->title }}</h3>
                        <p class="text-gray-400 text-sm">{{ Str::limit($article->description, 100) }}</p>
                    </div>
                @endforeach
            </div>
            <div class="p-6 border-t border-gray-700">
                <a href="{{ route('admin.articles') }}" class="text-blue-400 hover:text-blue-300 font-medium">
                    View all articles
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 