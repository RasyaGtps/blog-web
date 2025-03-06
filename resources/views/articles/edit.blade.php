@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg p-8">
        <h1 class="text-3xl font-bold mb-6 flex items-center gap-3">
            <i class="fas fa-edit text-gray-400"></i>
            Edit Article
        </h1>

        <form action="{{ route('articles.update', $article) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-heading text-gray-400"></i>
                    Title
                </label>
                <input type="text" name="title" id="title" 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400"
                    value="{{ old('title', $article->title) }}" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-align-left text-gray-400"></i>
                    Description
                </label>
                <textarea name="description" id="description" rows="3" 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400"
                    required>{{ old('description', $article->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-paragraph text-gray-400"></i>
                    Content
                </label>
                <textarea name="content" id="content" rows="10" 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400"
                    required>{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tags" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-tags text-gray-400"></i>
                    Tags
                </label>
                <select name="tags[]" id="tags" multiple 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" 
                            {{ in_array($tag->id, old('tags', $article->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                @error('tags')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if(auth()->user()->role === 'verified')
            <div class="mb-6">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-lock text-gray-400"></i>
                    Article Type
                </label>
                <select name="type" id="type" 
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400">
                    <option value="free" {{ old('type', $article->type) === 'free' ? 'selected' : '' }}>
                        <i class="fas fa-unlock"></i> Free
                    </option>
                    <option value="premium" {{ old('type', $article->type) === 'premium' ? 'selected' : '' }}>
                        <i class="fas fa-crown"></i> Premium
                    </option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endif

            <div class="flex justify-between items-center">
                <button type="submit" 
                    class="bg-black text-white px-6 py-2.5 rounded-full text-sm hover:bg-[#242424] transition-colors flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Update Article
                </button>

                <a href="{{ route('dashboard') }}" 
                    class="text-gray-600 hover:text-gray-800 transition-colors flex items-center gap-2">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>
        </form>

        <!-- Separate delete form -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="w-full bg-red-500 text-white px-6 py-2.5 rounded-full text-sm hover:bg-red-600 transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-trash-alt"></i>
                    Delete Article
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-resize textarea
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    // Prevent accidental navigation
    window.onbeforeunload = function() {
        if (document.querySelector('form').querySelector('[name="title"]').value !== '{{ $article->title }}' || 
            document.querySelector('form').querySelector('[name="description"]').value !== '{{ $article->description }}' ||
            document.querySelector('form').querySelector('[name="content"]').value !== '{{ $article->content }}') {
            return "You have unsaved changes. Are you sure you want to leave?";
        }
    };
</script>
@endsection
