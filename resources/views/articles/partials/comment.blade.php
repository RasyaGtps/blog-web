<div class="comment-container" style="margin-left: {{ $comment->level * 1 }}rem; border-left: 2px solid #e5e7eb; padding-left: 0.5rem;">
    <div class="bg-white rounded-lg p-4 shadow-sm">
        <!-- Comment Header -->
        <div class="flex justify-between items-start mb-2">
            <div class="flex items-center gap-2">
                <i class="fas fa-user-circle text-gray-400"></i>
                <span class="font-medium">{{ $comment->user->name }}</span>
                <span class="text-gray-500 text-sm">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
            </div>
            @can('delete', $comment)
            <form action="{{ route('comments.destroy', $comment) }}" 
                  method="POST" 
                  class="inline"
                  onsubmit="return confirm('Delete this comment?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
            @endcan
        </div>

        <!-- Comment Content -->
        <p class="text-gray-700 mb-3">{{ $comment->content }}</p>

        <!-- Reply Button & Form -->
        @auth
        <div x-data="{ showReplyForm: false }">
            <button @click="showReplyForm = !showReplyForm" 
                    class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
                <i class="fas fa-reply"></i>
                Reply
            </button>

            <form x-show="showReplyForm" 
                  x-cloak 
                  action="{{ route('comments.store', $article) }}" 
                  method="POST" 
                  class="mt-3 space-y-3">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea name="content" 
                          rows="2"
                          class="w-full rounded-lg border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 text-sm"
                          placeholder="Write a reply..."
                          required></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" 
                            @click="showReplyForm = false"
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-black text-white px-4 py-2 rounded-full text-sm hover:bg-gray-800">
                        Reply
                    </button>
                </div>
            </form>
        </div>
        @endauth

        <!-- Nested Replies -->
        @if($comment->replies->count() > 0)
            <div class="mt-4 space-y-4">
                @foreach($comment->replies as $reply)
                    @include('articles.partials.comment', ['comment' => $reply])
                @endforeach
            </div>
        @endif
    </div>
</div> 