@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Profile Header -->
    <div class="bg-[#242424] rounded-lg shadow-lg p-8 mb-8">
        <div class="flex items-start space-x-8">
            <!-- Avatar -->
            <div class="flex-shrink-0">
                @if($user->avatar && file_exists(public_path('avatars/' . $user->avatar)))
                <img src="{{ asset('avatars/' . $user->avatar) }}"
                    alt="{{ $user->username }}"
                    class="w-36 h-36 rounded-full object-cover border-4 border-[#2f2f2f] shadow-xl">
                @else
                <div class="w-36 h-36 rounded-full bg-[#2f2f2f] flex items-center justify-center text-3xl font-semibold text-gray-300 uppercase shadow-xl">
                    {{ Str::substr($user->username, 0, 2) }}
                </div>
                @endif
            </div>

            <!-- User Info -->
            <div class="flex-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="space-y-2">
                        <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                            {{ $user->name }}
                            <span class="text-purple-400 text-xl">
                                <i class="fas fa-crown" title="Admin"></i>
                            </span>
                        </h1>
                        <div class="flex items-center gap-2 text-gray-400">
                            <i class="fas fa-at text-sm"></i>
                            <span>{{ $user->username }}</span>
                        </div>
                        @if($user->email)
                        <div class="flex items-center gap-2 text-gray-400">
                            <i class="fas fa-envelope text-sm"></i>
                            <span>{{ $user->email }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-4 py-2 rounded-full bg-[#2f2f2f] text-purple-400 text-sm font-medium flex items-center gap-2">
                            <i class="fas fa-shield-alt"></i>
                            Administrator
                        </span>
                        @if($user->membership === 'free')
                        <span class="px-4 py-2 rounded-full bg-[#2f2f2f] text-gray-400 text-sm font-medium flex items-center gap-2">
                            <i class="fas fa-user"></i>
                            Free User
                        </span>
                        @elseif($user->membership === 'basic')
                        <span class="px-4 py-2 rounded-full bg-[#2f2f2f] text-blue-400 text-sm font-medium flex items-center gap-2">
                            <i class="fas fa-star"></i>
                            Basic Member
                        </span>
                        @else
                        <span class="px-4 py-2 rounded-full bg-[#2f2f2f] text-yellow-400 text-sm font-medium flex items-center gap-2">
                            <i class="fas fa-crown"></i>
                            Premium Member
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Bio -->
                @if($user->bio)
                <div class="bg-[#2f2f2f] rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2 text-gray-400 mb-2">
                        <i class="fas fa-quote-left"></i>
                        <span class="text-sm font-medium">Bio</span>
                    </div>
                    <p class="text-gray-300">{{ $user->bio }}</p>
                </div>
                @endif

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-[#2f2f2f] rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-white mb-1">{{ $user->articles_count }}</div>
                        <div class="text-gray-400 flex items-center justify-center gap-2">
                            <i class="fas fa-newspaper"></i>
                            <span>Articles</span>
                        </div>
                    </div>
                    <div class="bg-[#2f2f2f] rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-white mb-1">{{ $user->followers_count }}</div>
                        <div class="text-gray-400 flex items-center justify-center gap-2">
                            <i class="fas fa-users"></i>
                            <span>Followers</span>
                        </div>
                    </div>
                    <div class="bg-[#2f2f2f] rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-white mb-1">{{ $user->following_count }}</div>
                        <div class="text-gray-400 flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Following</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User's Articles -->
    <div class="space-y-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                <i class="fas fa-newspaper text-gray-400"></i>
                My Articles
            </h2>
        </div>

        @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
            <div class="bg-[#242424] rounded-lg shadow-lg overflow-hidden hover:transform hover:scale-105 transition-all duration-200">
                <a href="{{ route('articles.show', $article) }}" class="block">
                    @if($article->cover_image)
                    <img src="{{ $article->cover_image }}"
                        alt="{{ $article->title }}"
                        class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-[#2f2f2f] flex items-center justify-center">
                        <i class="fas fa-newspaper text-4xl text-gray-600"></i>
                    </div>
                    @endif
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 text-white hover:text-blue-400 transition-colors">
                            {{ $article->title }}
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">{{ Str::limit($article->description, 100) }}</p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span class="flex items-center gap-2">
                                <i class="far fa-calendar-alt"></i>
                                {{ $article->created_at->format('M d, Y') }}
                            </span>
                            <span class="flex items-center gap-2">
                                <i class="far fa-clock"></i>
                                {{ $article->read_time ?? '5' }} min read
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
        @else
        <div class="bg-[#242424] rounded-lg p-8 text-center">
            <div class="text-gray-400 text-6xl mb-4">
                <i class="fas fa-newspaper"></i>
            </div>
            <h3 class="text-xl font-medium text-white mb-2">No Articles Yet</h3>
            <p class="text-gray-400 mb-6">Start writing and sharing your thoughts with the world!</p>
            <a href="{{ route('admin.articles.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors">
                <i class="fas fa-plus"></i>
                <span>Create Your First Article</span>
            </a>
        </div>
        @endif
    </div>
</div>
@endsection