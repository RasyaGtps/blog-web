@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Profile Header -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex items-start space-x-6">
            <!-- Avatar -->
            <div class="flex-shrink-0">
                @if($user->avatar && file_exists(public_path('avatars/' . $user->avatar)))
                    <img src="{{ asset('avatars/' . $user->avatar) }}" 
                         alt="{{ $user->username }}" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-gray-200">
                @else
                    <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-2xl font-semibold text-gray-600 uppercase">
                        {{ Str::substr($user->username, 0, 2) }}
                    </div>
                @endif
            </div>

            <!-- User Info -->
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                        <div class="flex items-center gap-1 text-gray-600">
                            <span>{{ '@' . $user->username }}</span>
                            @if($user->role === 'verified')
                                <span class="text-blue-600">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    @auth
                        @if(auth()->user()->id !== $user->id)
                            @if(auth()->user()->isFollowing($user))
                                <form action="{{ route('user.unfollow', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-gray-200 text-gray-800 px-6 py-2 rounded-full hover:bg-red-500 hover:text-white group">
                                        <span class="block group-hover:hidden">Following</span>
                                        <span class="hidden group-hover:block">Unfollow</span>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('user.follow', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">
                                        Follow
                                    </button>
                                </form>
                            @endif
                        @endif
                    @endauth
                </div>

                <!-- Bio -->
                @if($user->bio)
                    <p class="mt-4 text-gray-700">{{ $user->bio }}</p>
                @endif

                <!-- Stats -->
                <div class="flex items-center gap-6 mt-6">
                    <div class="text-center">
                        <span class="block font-bold text-gray-900">{{ $user->articles_count }}</span>
                        <span class="text-gray-600">Articles</span>
                    </div>
                    <a href="{{ route('user.followers', $user) }}" class="text-center hover:text-blue-600">
                        <span class="block font-bold text-gray-900">{{ $user->followers_count }}</span>
                        <span class="text-gray-600">Followers</span>
                    </a>
                    <a href="{{ route('user.following', $user) }}" class="text-center hover:text-blue-600">
                        <span class="block font-bold text-gray-900">{{ $user->following_count }}</span>
                        <span class="text-gray-600">Following</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- User's Articles -->
    <div class="space-y-6">
        <h2 class="text-2xl font-bold">Articles</h2>
        @if($articles->count() > 0)
            <div class="flex flex-wrap gap-6">
                @foreach($articles as $article)
                    <div class="bg-white rounded-lg shadow overflow-hidden w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                        <a href="{{ route('articles.show', $article) }}" class="block h-full">
                            @if($article->cover_image)
                                <div class="aspect-w-16 aspect-h-9">
                                    <img src="{{ $article->cover_image }}" 
                                         alt="{{ $article->title }}" 
                                         class="w-full object-cover">
                                </div>
                            @endif
                            <div class="p-4 flex flex-col h-full">
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg mb-2 truncate">{{ $article->title }}</h3>
                                    <p class="text-gray-600 text-sm whitespace-pre-line">{{ $article->description }}</p>
                                </div>
                                <div class="flex items-center justify-between text-sm text-gray-500 mt-4">
                                    <span>{{ $article->created_at->format('M d, Y') }}</span>
                                    <span>{{ $article->read_time ?? '5' }} min read</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $articles->links() }}
            </div>
        @else
            <p class="text-gray-600">No articles yet.</p>
        @endif
    </div>
</div>
@endsection 