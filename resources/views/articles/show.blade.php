@extends('layouts.app')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 py-8">
    <!-- Article Header -->
    <h1 class="text-4xl font-bold font-serif mb-4 leading-tight">{{ $article->title }}</h1>
    
    <!-- Article Description -->
    <p class="text-xl text-gray-600 mb-4 leading-relaxed">
        {{ $article->description }}
    </p>
    <!-- Author Info & Article Meta -->
    <div class="flex items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->username) }}" 
                 alt="{{ $article->user->username }}" 
                 class="w-12 h-12 rounded-full">
            <div>
                <div class="flex items-center gap-2">
                    <a href="#" class="font-medium hover:text-gray-600">{{ $article->user->username }}</a>
                    @if($article->user->role === 'verified')
                        <span class="text-blue-600">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    @endif
                    <button class="text-green-600 hover:text-green-700 px-3 py-1 rounded-full border border-green-600 text-sm">
                        Follow
                    </button>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mt-1">
                    <span>{{ $article->read_time ?? '5' }} min read</span>
                    <span>·</span>
                    <span>{{ $article->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Stats -->
    <div class="flex items-center gap-6 border-b border-gray-200 pb-8 mb-8 text-sm text-gray-500">
        <div class="flex items-center gap-2">
            <i class="far fa-eye"></i>
            <span>{{ number_format($article->views) }} views</span>
        </div>
        <div class="flex items-center gap-2">
            <i class="far fa-comment"></i>
            <span>{{ $article->comments->count() }} comments</span>
        </div>
    </div>

    <!-- Article Content -->
    <div class="prose max-w-none mb-8">
        {!! $article->content !!}
    </div>

    <!-- Tags Below -->
    @if($article->tags->count() > 0)
        <div class="flex flex-wrap gap-2 py-6 border-t border-gray-200">
            @foreach($article->tags as $tag)
                <a href="#" class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-200 hover:bg-gray-300 transition-colors">
                    <span class="text-gray-600">#</span>
                    <span class="text-gray-800">{{ $tag->name }}</span>
                </a>
            @endforeach
        </div>
    @endif

    <!-- Article Stats Bottom -->
    <div class="flex items-center gap-6 py-4 border-t border-gray-200 text-gray-500">
        <div class="flex items-center gap-2">
            <i class="far fa-eye"></i>
            <span>{{ number_format($article->views) }}</span>
        </div>
        <div class="flex items-center gap-2">
            <i class="far fa-comment"></i>
            <span>{{ $article->comments->count() }}</span>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="mt-12">
        <h2 class="text-xl font-bold mb-8">Responses ({{ $article->comments->count() }})</h2>

        <!-- Comment Form -->
        @auth
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" 
                         alt="{{ auth()->user()->name }}" 
                         class="w-8 h-8 rounded-full">
                    <span class="font-medium">{{ auth()->user()->name }}</span>
                    @if(auth()->user()->role === 'verified')
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                            <i class="fas fa-check-circle text-xs"></i>
                            Verified
                        </span>
                    @endif
                </div>
                <div class="pl-10">
                    <form action="{{ route('comments.store', $article) }}" method="POST">
                        @csrf
                        <textarea name="content" 
                                  class="w-full p-3 bg-gray-200 rounded-lg border-0 focus:ring-0 text-base resize-none focus:bg-white transition-colors"
                                  rows="1"
                                  placeholder="What are your thoughts?"
                                  required></textarea>
                        <div class="flex justify-end mt-2">
                            <button type="submit" 
                                    class="bg-green-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-green-700">
                                Respond
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="bg-gray-50 rounded-lg p-4 text-center mb-8">
                <a href="{{ route('login') }}" class="text-green-600 hover:underline">Sign in</a> to leave a response.
            </div>
        @endauth

        <!-- Comments List -->
        <div class="space-y-6">
            @foreach($article->comments()->whereNull('parent_id')->latest()->get() as $comment)
                <div class="flex gap-3" x-data="{ showReplyForm: false }">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}" 
                         alt="{{ $comment->user->name }}" 
                         class="w-8 h-8 rounded-full">
                    <div class="flex-1">
                        <!-- Comment Header -->
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-medium">{{ $comment->user->name }}</span>
                            @if($comment->user->id === $article->user_id)
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fas fa-pen text-xs"></i>
                                    Author
                                </span>
                            @endif
                            @if($comment->user->role === 'verified')
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fas fa-check-circle text-xs"></i>
                                    Verified
                                </span>
                            @endif
                            <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>

                        <!-- Comment Content -->
                        <div class="text-gray-800 mb-2">{{ $comment->content }}</div>

                        <!-- Comment Actions -->
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <button @click="showReplyForm = !showReplyForm" class="hover:text-gray-700">
                                Reply
                            </button>
                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Delete this comment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="hover:text-red-500">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>

                        <!-- Reply Form -->
                        @auth
                            <div x-show="showReplyForm" x-cloak class="mt-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" 
                                         alt="{{ auth()->user()->name }}" 
                                         class="w-8 h-8 rounded-full">
                                    <span class="font-medium">{{ auth()->user()->name }}</span>
                                    @if(auth()->user()->role === 'verified')
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                            <i class="fas fa-check-circle text-xs"></i>
                                            Verified
                                        </span>
                                    @endif
                                </div>
                                <div class="pl-10">
                                    <form action="{{ route('comments.store', $article) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <textarea name="content" 
                                                  class="w-full p-3 bg-gray-200 rounded-lg border-0 focus:ring-0 text-base resize-none focus:bg-white transition-colors"
                                                  rows="1"
                                                  placeholder="What are your thoughts?"
                                                  required></textarea>
                                        <div class="flex justify-end gap-2 mt-2">
                                            <button type="button" 
                                                    @click="showReplyForm = false"
                                                    class="text-gray-500 hover:text-gray-700 text-sm">
                                                Cancel
                                            </button>
                                            <button type="submit" 
                                                    class="bg-green-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-green-700">
                                                Respond
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endauth

                        <!-- Nested Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="mt-4 space-y-4">
                                @foreach($comment->replies as $reply)
                                    <div class="flex gap-3 pl-8">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->name) }}" 
                                             alt="{{ $reply->user->name }}" 
                                             class="w-8 h-8 rounded-full">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-medium">{{ $reply->user->name }}</span>
                                                @if($reply->user->id === $article->user_id)
                                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                                        <i class="fas fa-pen text-xs"></i>
                                                        Author
                                                    </span>
                                                @endif
                                                @if($reply->user->role === 'verified')
                                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                                        <i class="fas fa-check-circle text-xs"></i>
                                                        Verified
                                                    </span>
                                                @endif
                                                <span class="text-gray-500 text-sm">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="text-gray-800 mb-2">{{ $reply->content }}</div>
                                            @can('delete', $reply)
                                                <form action="{{ route('comments.destroy', $reply) }}" 
                                                      method="POST" 
                                                      class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm text-gray-500 hover:text-red-500">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
