@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-white">Edit Article</h1>
            <a href="{{ route('admin.articles') }}" 
               class="flex items-center gap-2 text-gray-400 hover:text-white">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Articles</span>
            </a>
        </div>

        <form action="{{ route('admin.articles.update', $article) }}" 
              method="POST" 
              class="bg-[#242424] rounded-lg shadow-lg p-6">
            @csrf
            @method('PATCH')

            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label class="block text-gray-400 mb-2">Title</label>
                    <input type="text" 
                           name="title" 
                           value="{{ old('title', $article->title) }}"
                           required
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-gray-400 mb-2">Description</label>
                    <textarea name="description" 
                              rows="3"
                              required
                              class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $article->description) }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label class="block text-gray-400 mb-2">Content</label>
                    <textarea name="content" 
                              rows="15"
                              required
                              class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content', $article->content) }}</textarea>
                    @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover Image URL -->
                <div>
                    <label class="block text-gray-400 mb-2">Cover Image URL</label>
                    <input type="url" 
                           name="cover_image" 
                           value="{{ old('cover_image', $article->cover_image) }}"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('cover_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-gray-400 mb-2">Tags</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($tags as $tag)
                        <label class="flex items-center space-x-2 bg-[#2f2f2f] rounded p-3 cursor-pointer hover:bg-[#383838]">
                            <input type="checkbox" 
                                   name="tags[]" 
                                   value="{{ $tag->id }}"
                                   @checked(in_array($tag->id, old('tags', $selectedTags)))
                                   class="rounded border-gray-600 text-blue-600 focus:ring-blue-500 bg-[#242424]">
                            <span class="text-gray-300">{{ $tag->name }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('tags')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Article Type -->
                <div>
                    <label class="block text-gray-400 mb-2">Article Type</label>
                    <select name="type" 
                            required
                            class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="free" @selected(old('type', $article->type) === 'free')>Free</option>
                        <option value="premium" @selected(old('type', $article->type) === 'premium')>Premium</option>
                    </select>
                    @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Preview Current Cover -->
                @if($article->cover_image)
                <div>
                    <label class="block text-gray-400 mb-2">Current Cover Image</label>
                    <img src="{{ $article->cover_image }}" 
                         alt="{{ $article->title }}" 
                         class="w-full max-w-xl rounded-lg shadow-lg">
                </div>
                @endif

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.articles') }}"
                       class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Update Article
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 