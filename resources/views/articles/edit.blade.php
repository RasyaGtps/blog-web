@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-6">Edit Article</h1>

        <form action="{{ route('articles.update', $article) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" id="title" 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400"
                    value="{{ old('title', $article->title) }}" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea name="content" id="content" rows="10" 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400"
                    required>{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" 
                    class="bg-black text-white px-6 py-2.5 rounded-full text-sm hover:bg-[#242424] transition-colors">
                    Update Article
                </button>

                <a href="{{ route('articles.show', $article) }}" 
                    class="text-gray-600 hover:text-gray-800 transition-colors">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Separate delete form -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <form action="{{ route('articles.destroy', $article) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="w-full bg-red-500 text-white px-6 py-2.5 rounded-full text-sm hover:bg-red-600 transition-colors"
                    onclick="return confirm('Are you sure you want to delete this article?')">
                    Delete Article
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-resize textarea
    const textarea = document.querySelector('textarea');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // Prevent accidental navigation
    window.onbeforeunload = function() {
        if (document.querySelector('form').querySelector('[name="title"]').value !== '{{ $article->title }}' || 
            document.querySelector('form').querySelector('[name="content"]').value !== '{{ $article->content }}') {
            return "You have unsaved changes. Are you sure you want to leave?";
        }
    };
</script>
@endsection
