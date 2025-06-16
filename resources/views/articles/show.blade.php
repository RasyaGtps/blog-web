@extends('layouts.app')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 py-8">
    <!-- Article Header -->
    <h1 class="text-4xl font-bold font-serif mb-4 leading-tight">{{ $article->title }}</h1>
    
    <!-- Article Description -->
    <p class="text-xl text-gray-600 mb-4 leading-relaxed text-justify">
        {{ $article->description }}
    </p>
    <!-- Author Info & Article Meta -->
    <div class="flex items-center gap-4 mb-8">
        <div class="flex items-center gap-3">
            @if($article->user->avatar)
                <img src="/avatars/{{ $article->user->avatar }}" 
                     alt="{{ $article->user->username }}" 
                     class="w-12 h-12 rounded-full object-cover">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->username) }}" 
                     alt="{{ $article->user->username }}" 
                     class="w-12 h-12 rounded-full">
            @endif
            <div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('profile.show', $article->user->username) }}" class="font-medium hover:text-gray-600">
                        {{ $article->user->username }}
                    </a>
                    @if($article->user->role === 'verified')
                        <span class="text-blue-600">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    @endif
                    @auth
                        @if(auth()->user()->id !== $article->user->id)
                            @if(auth()->user()->isFollowing($article->user))
                                <form action="{{ route('user.unfollow', $article->user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-green-600 hover:text-green-700 px-3 py-1 rounded-full border border-green-600 text-sm">
                                        Following
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('user.follow', $article->user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-700 px-3 py-1 rounded-full border border-green-600 text-sm">
                                        Follow
                                    </button>
                                </form>
                            @endif
                        @endif
                    @endauth
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
        <div class="max-w-[1200px] text-lg">
            @foreach(preg_split('/\n\s*\n/', $article->content) as $paragraph)
                @if(trim($paragraph))
                    <p class="mb-6 text-justify">{{ $paragraph }}</p>
                @endif
            @endforeach
        </div>
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
        @auth
            <div class="flex items-center gap-2" x-data="{ isLiked: {{ $article->isLikedBy(auth()->user()) ? 'true' : 'false' }}, likesCount: {{ $article->likes()->count() }} }">
                <form x-show="!isLiked" 
                      @submit.prevent="
                        fetch('{{ route('articles.like', $article) }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            isLiked = true;
                            likesCount = data.likes_count;
                        })">
                    <button type="submit" class="flex items-center gap-1 hover:text-blue-600">
                        <i class="far fa-heart"></i>
                        <span x-text="likesCount"></span>
                    </button>
                </form>
                <form x-show="isLiked" 
                      @submit.prevent="
                        fetch('{{ route('articles.unlike', $article) }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: new URLSearchParams({
                                '_method': 'DELETE'
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            isLiked = false;
                            likesCount = data.likes_count;
                        })">
                    <button type="submit" class="flex items-center gap-1 text-blue-600">
                        <i class="fas fa-heart"></i>
                        <span x-text="likesCount"></span>
                    </button>
                </form>
            </div>
        @else
            <div class="flex items-center gap-2">
                <i class="far fa-heart"></i>
                <span>{{ $article->likes()->count() }}</span>
            </div>
        @endauth
    </div>

    <!-- Comments Section -->
    <div class="mt-12">
        <h2 class="text-xl font-bold mb-8">Komentar ({{ $article->comments->count() }})</h2>

        <!-- Comment Form -->
        @auth
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-2">
                    <a href="{{ route('profile.show', auth()->user()->username) }}" class="flex items-center gap-2">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" 
                                 alt="{{ auth()->user()->username }}" 
                                 class="w-8 h-8 rounded-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}" 
                                 alt="{{ auth()->user()->username }}" 
                                 class="w-8 h-8 rounded-full">
                        @endif
                        <span class="font-medium hover:text-blue-600">{{ auth()->user()->username }}</span>
                    </a>
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
                                  class="w-full p-3 bg-gray-100 rounded-lg border-0 focus:ring-0 text-base resize-none focus:bg-white transition-colors"
                                  rows="1"
                                  placeholder="Tulis komentar..."
                                  required></textarea>
                        <div class="flex justify-end mt-2">
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-blue-700">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="bg-gray-50 rounded-lg p-4 text-center mb-8">
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Sign in</a> to leave a response.
            </div>
        @endauth

        <!-- Comments List -->
        <div class="space-y-6">
            @foreach($article->comments()->whereNull('parent_id')->latest()->get() as $comment)
                <div class="flex gap-3" x-data="{ showReplyForm: false }">
                    <a href="{{ route('profile.show', $comment->user->username) }}" class="flex-shrink-0">
                        @if($comment->user->avatar)
                            <img src="{{ asset('avatars/' . $comment->user->avatar) }}" 
                                 alt="{{ $comment->user->username }}" 
                                 class="w-8 h-8 rounded-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->username) }}" 
                                 alt="{{ $comment->user->username }}" 
                                 class="w-8 h-8 rounded-full">
                        @endif
                    </a>

                    <div class="flex-1">
                        <!-- Comment Header -->
                        <div class="flex items-center gap-2 mb-1">
                            <a href="{{ route('profile.show', $comment->user->username) }}" class="font-medium hover:text-blue-600">
                                {{ $comment->user->username }}
                            </a>
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
                            @auth
                            <button @click="showReplyForm = !showReplyForm" class="hover:text-gray-700">
                                Reply
                            </button>
                                @can('update', $comment)
                                    <button @click="$dispatch('edit-comment', { id: {{ $comment->id }}, content: '{{ $comment->content }}' })" class="hover:text-blue-600">
                                        Edit
                                    </button>
                                @endcan
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
                            @endauth
                        </div>

                        <!-- Edit Comment Form -->
                        @can('update', $comment)
                        <div x-data="{ showEditForm: false, editContent: '' }" 
                             @edit-comment.window="if ($event.detail.id === {{ $comment->id }}) { 
                                showEditForm = true; 
                                editContent = $event.detail.content;
                             }">
                            <div x-show="showEditForm" x-cloak class="mt-4">
                                <form action="{{ route('comments.update', $comment) }}" method="POST">
                                        @csrf
                                    @method('PUT')
                                        <textarea name="content" 
                                              x-model="editContent"
                                                  class="w-full p-3 bg-gray-100 rounded-lg border-0 focus:ring-0 text-base resize-none focus:bg-white transition-colors"
                                              rows="2"
                                                  required></textarea>
                                        <div class="flex justify-end gap-2 mt-2">
                                            <button type="button" 
                                                @click="showEditForm = false"
                                                    class="text-gray-500 hover:text-gray-700 text-sm">
                                                Cancel
                                            </button>
                                            <button type="submit" 
                                                    class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-blue-700">
                                            Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endcan

                        <!-- Nested Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="mt-4 space-y-4">
                                @foreach($comment->replies as $reply)
                                    <div class="flex gap-3 pl-8" x-data="{ showReplyForm: false }">
                                        <a href="{{ route('profile.show', $reply->user->username) }}" class="flex-shrink-0">
                                            @if($reply->user->avatar)
                                                <img src="{{ asset('avatars/' . $reply->user->avatar) }}" 
                                                     alt="{{ $reply->user->username }}" 
                                                     class="w-8 h-8 rounded-full object-cover">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->username) }}" 
                                                     alt="{{ $reply->user->username }}" 
                                                     class="w-8 h-8 rounded-full">
                                            @endif
                                        </a>
                                        <div class="flex-1">
                                            <!-- Reply Header -->
                                            <div class="flex items-center gap-2 mb-1">
                                                <a href="{{ route('profile.show', $reply->user->username) }}" class="font-medium hover:text-blue-600">
                                                    {{ $reply->user->username }}
                                                </a>
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

                                            <!-- Reply Content -->
                                            <div class="text-gray-800 mb-2">{{ $reply->content }}</div>

                                            <!-- Reply Actions -->
                                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                                @auth
                                                    <button @click="showReplyForm = !showReplyForm" class="hover:text-gray-700">
                                                        Reply
                                                    </button>
                                                    @can('update', $reply)
                                                        <button @click="$dispatch('edit-comment', { id: {{ $reply->id }}, content: '{{ $reply->content }}' })" class="hover:text-blue-600">
                                                            Edit
                                                        </button>
                                                    @endcan
                                                    @can('delete', $reply)
                                                        <form action="{{ route('comments.destroy', $reply) }}" 
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
                                                @endauth
                                            </div>

                                            <!-- Edit Reply Form -->
                                            @can('update', $reply)
                                                <div x-data="{ showEditForm: false, editContent: '' }" 
                                                     @edit-comment.window="if ($event.detail.id === {{ $reply->id }}) { 
                                                        showEditForm = true; 
                                                        editContent = $event.detail.content;
                                                     }">
                                                    <div x-show="showEditForm" x-cloak class="mt-4">
                                                        <form action="{{ route('comments.update', $reply) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <textarea name="content" 
                                                                      x-model="editContent"
                                                                      class="w-full p-3 bg-gray-100 rounded-lg border-0 focus:ring-0 text-base resize-none focus:bg-white transition-colors"
                                                                      rows="2"
                                                                      required></textarea>
                                                            <div class="flex justify-end gap-2 mt-2">
                                                                <button type="button" 
                                                                        @click="showEditForm = false"
                                                                        class="text-gray-500 hover:text-gray-700 text-sm">
                                                                    Cancel
                                                                </button>
                                                                <button type="submit" 
                                                                        class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-blue-700">
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endcan

                                            <!-- Reply Form for Nested Reply -->
                                            @auth
                                                <div x-show="showReplyForm" x-cloak class="mt-4">
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <a href="{{ route('profile.show', auth()->user()->username) }}" class="flex items-center gap-2">
                                                            @if(auth()->user()->avatar)
                                                                <img src="{{ asset('avatars/' . auth()->user()->avatar) }}" 
                                                                     alt="{{ auth()->user()->username }}" 
                                                                     class="w-8 h-8 rounded-full object-cover">
                                                            @else
                                                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}" 
                                                                     alt="{{ auth()->user()->username }}" 
                                                                     class="w-8 h-8 rounded-full">
                                                            @endif
                                                            <span class="font-medium hover:text-blue-600">{{ auth()->user()->username }}</span>
                                                        </a>
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
                                                            <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                                            <textarea name="content" 
                                                                      class="w-full p-3 bg-gray-100 rounded-lg border-0 focus:ring-0 text-base resize-none focus:bg-white transition-colors"
                                                                      rows="1"
                                                                      placeholder="Tulis balasan..."
                                                                      required></textarea>
                                                            <div class="flex justify-end gap-2 mt-2">
                                                                <button type="button" 
                                                                        @click="showReplyForm = false"
                                                                        class="text-gray-500 hover:text-gray-700 text-sm">
                                                                    Cancel
                                                                </button>
                                                                <button type="submit" 
                                                                        class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-blue-700">
                                                                    Kirim
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endauth

                                            <!-- Show Nested Replies -->
                                            @if($reply->replies->count() > 0)
                                                <div class="mt-4 space-y-4">
                                                    @foreach($reply->replies as $nestedReply)
                                                        <div class="flex gap-3 pl-8">
                                                            <a href="{{ route('profile.show', $nestedReply->user->username) }}" class="flex-shrink-0">
                                                                @if($nestedReply->user->avatar)
                                                                    <img src="{{ asset('avatars/' . $nestedReply->user->avatar) }}" 
                                                                         alt="{{ $nestedReply->user->username }}" 
                                                                         class="w-8 h-8 rounded-full object-cover">
                                                                @else
                                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($nestedReply->user->username) }}" 
                                                                         alt="{{ $nestedReply->user->username }}" 
                                                                         class="w-8 h-8 rounded-full">
                                                                @endif
                                                            </a>
                                                            <div class="flex-1">
                                                                <div class="flex items-center gap-2 mb-1">
                                                                    <a href="{{ route('profile.show', $nestedReply->user->username) }}" class="font-medium hover:text-blue-600">
                                                                        {{ $nestedReply->user->username }}
                                                                    </a>
                                                                    @if($nestedReply->user->id === $article->user_id)
                                                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                                                            <i class="fas fa-pen text-xs"></i>
                                                                            Author
                                                                        </span>
                                                                    @endif
                                                                    @if($nestedReply->user->role === 'verified')
                                                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                                                                            <i class="fas fa-check-circle text-xs"></i>
                                                                            Verified
                                                                        </span>
                                                                    @endif
                                                                    <span class="text-gray-500 text-sm">{{ $nestedReply->created_at->diffForHumans() }}</span>
                                                                </div>
                                                                <div class="text-gray-800 mb-2">{{ $nestedReply->content }}</div>
                                                                
                                                                <!-- Nested Reply Actions -->
                                                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                                                    @auth
                                                                        @can('update', $nestedReply)
                                                                            <button @click="$dispatch('edit-comment', { id: {{ $nestedReply->id }}, content: '{{ $nestedReply->content }}' })" class="hover:text-blue-600">
                                                                                Edit
                                                                            </button>
                                                                        @endcan
                                                                        @can('delete', $nestedReply)
                                                                            <form action="{{ route('comments.destroy', $nestedReply) }}" 
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
                                                                    @endauth
                                                                </div>

                                                                <!-- Edit Nested Reply Form -->
                                                                @can('update', $nestedReply)
                                                                    <div x-data="{ showEditForm: false, editContent: '' }" 
                                                                         @edit-comment.window="if ($event.detail.id === {{ $nestedReply->id }}) { 
                                                                            showEditForm = true; 
                                                                            editContent = $event.detail.content;
                                                                         }">
                                                                        <div x-show="showEditForm" x-cloak class="mt-4">
                                                                            <form action="{{ route('comments.update', $nestedReply) }}" method="POST">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <textarea name="content" 
                                                                                          x-model="editContent"
                                                                                          class="w-full p-3 bg-gray-100 rounded-lg border-0 focus:ring-0 text-base resize-none focus:bg-white transition-colors"
                                                                                          rows="2"
                                                                                          required></textarea>
                                                                                <div class="flex justify-end gap-2 mt-2">
                                                                                    <button type="button" 
                                                                                            @click="showEditForm = false"
                                                                                            class="text-gray-500 hover:text-gray-700 text-sm">
                                                                                        Cancel
                                                                                    </button>
                                                                                    <button type="submit" 
                                                                                            class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-sm hover:bg-blue-700">
                                                                                        Update
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
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
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
