@extends('layouts.app')

@section('content')
<div class="container max-w-[800px] mx-auto px-4 py-8">
    <div class="bg-white rounded-lg p-6 shadow-sm">
        <h1 class="text-2xl font-bold mb-6">Write a Story</h1>

        <form action="{{ route('articles.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" 
                       name="title" 
                       id="title"
                       class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400"
                       placeholder="Title"
                       value="{{ old('title') }}"
                       required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea name="content" 
                          id="content"
                          rows="12"
                          class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400 resize-none"
                          placeholder="Tell your story..."
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-between pt-6 border-t">
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-100 text-gray-700 px-6 py-2.5 rounded-full text-sm hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-black text-white px-6 py-2.5 rounded-full text-sm hover:bg-[#242424] transition-colors">
                    Publish Story
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-resize textarea
    const textarea = document.querySelector('textarea');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Prevent accidental navigation
    window.onbeforeunload = function() {
        if (document.querySelector('form').querySelector('[name="title"]').value || 
            document.querySelector('form').querySelector('[name="content"]').value) {
            return "You have unsaved changes. Are you sure you want to leave?";
        }
    };
</script>
@endsection