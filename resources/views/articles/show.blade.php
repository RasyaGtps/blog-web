@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Article Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-4">{{ $article->title }}</h1>
        <div class="flex items-center text-gray-600 text-sm mb-6">
            <div class="flex items-center">
                <i class="fas fa-user mr-2"></i>
                <span>{{ $article->user->name }}</span>
            </div>
            <div class="mx-4">•</div>
            <div class="flex items-center">
                <i class="fas fa-calendar mr-2"></i>
                <span>{{ $article->created_at->format('M d, Y') }}</span>
            </div>
            <div class="mx-4">•</div>
            <div class="flex items-center">
                <i class="fas fa-eye mr-2"></i>
                <span>{{ number_format($article->views) }} views</span>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="prose max-w-none mb-12">
        {!! $article->content !!}
    </div>

    <!-- Comments Section -->
    <div class="mt-8 space-y-8">
        <h3 class="text-2xl font-bold flex items-center gap-2">
            <i class="far fa-comments"></i>
            Comments ({{ $article->comments->count() }})
        </h3>

        <!-- Comment Form -->
        @auth
        <form action="{{ route('comments.store', $article) }}" method="POST" class="space-y-4">
            @csrf
            <textarea name="content" 
                      rows="3"
                      class="w-full rounded-lg border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200"
                      placeholder="Write a comment..."
                      required></textarea>
            @error('content')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            <button type="submit" 
                    class="bg-black text-white px-6 py-2 rounded-full text-sm hover:bg-gray-800 transition-colors">
                Post Comment
            </button>
        </form>
        @else
        <div class="bg-gray-50 p-4 rounded-lg text-center">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Sign in</a> to join the discussion.
        </div>
        @endauth

        <!-- Comments List -->
        <div class="space-y-6">
            @foreach($article->comments()->whereNull('parent_id')->latest()->get() as $comment)
                @include('articles.partials.comment', ['comment' => $comment])
            @endforeach
        </div>
    </div>
</div>
@endsection
