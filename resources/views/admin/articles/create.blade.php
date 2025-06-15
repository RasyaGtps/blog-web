@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-white">Create New Article</h1>
            <a href="{{ route('admin.articles') }}" 
               class="flex items-center gap-2 text-gray-400 hover:text-white">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Articles</span>
            </a>
        </div>

        <form action="{{ route('admin.articles.store') }}" 
              method="POST" 
              class="bg-[#242424] rounded-lg shadow-lg p-6">
            @csrf

            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label class="block text-gray-400 mb-2">Title</label>
                    <input type="text" 
                           name="title" 
                           value="{{ old('title') }}"
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
                              class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label class="block text-gray-400 mb-2">Content</label>
                    <textarea name="content" 
                              rows="10"
                              required
                              class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content') }}</textarea>
                    @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-gray-400 mb-2">Tags (max 5)</label>
                    <div class="relative">
                        <select name="tags[]" id="tags" multiple class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" x-data="{}" x-init="() => { choices = new Choices($el, { removeItems: true, removeItemButton: true, maxItemCount: 5, placeholder: true, placeholderValue: 'Select up to 5 tags', position: 'bottom', searchEnabled: true, searchChoices: true, hideSelected: true, renderChoiceLimit: -1, addItemFilter: function() { return this.getValue(true).length < 5; }, maxItemText: () => '' }); choices.passedElement.element.addEventListener('addItem', function() { if (choices.getValue(true).length >= 5) { const input = document.querySelector('.choices__input--cloned'); if (input) input.placeholder = ''; } }); choices.passedElement.element.addEventListener('removeItem', function() { const input = document.querySelector('.choices__input--cloned'); if (input) input.placeholder = 'Select up to 5 tags'; }); }">@foreach($tags as $tag)<option value="{{ $tag->id }}">{{ $tag->name }}</option>@endforeach</select>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Choose up to 5 tags that best describe your story</p>
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
                        <option value="free" {{ old('type') === 'free' ? 'selected' : '' }}>Free</option>
                        <option value="premium" {{ old('type') === 'premium' ? 'selected' : '' }}>Premium</option>
                    </select>
                    @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.articles') }}"
                       class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Create Article
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    /* Override Choices.js styles for dark theme */
    .choices {
        margin-bottom: 0 !important;
    }
    .choices__inner {
        background: #2f2f2f !important;
        border: 1px solid #4b5563 !important;
        border-radius: 0.375rem !important;
        min-height: 42px !important;
        padding: 6px 8px !important;
    }
    .choices__input {
        background: #2f2f2f !important;
        color: #d1d5db !important;
    }
    .choices__list--dropdown {
        background: #2f2f2f !important;
        border: 1px solid #4b5563 !important;
        border-radius: 0.375rem !important;
        margin-top: 2px !important;
    }
    .choices__list--dropdown .choices__item {
        color: #d1d5db !important;
        padding: 8px 10px !important;
    }
    .choices__list--dropdown .choices__item--selectable.is-highlighted {
        background: #374151 !important;
    }
    .choices__list--multiple .choices__item {
        background: #3b82f6 !important;
        border: none !important;
        border-radius: 9999px !important;
        color: white !important;
        margin: 3px !important;
        padding: 3px 10px !important;
    }
    .choices__list--multiple .choices__item.is-highlighted {
        background: #2563eb !important;
    }
    .choices__button {
        background-image: url("data:image/svg+xml,%3Csvg width='21' height='21' viewBox='0 0 21 21' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-rule='evenodd'%3E%3Cpath d='M2.592.044l18.364 18.364-2.548 2.548L.044 2.592z'/%3E%3Cpath d='M0 18.364L18.364 0l2.548 2.548L2.548 20.912z'/%3E%3C/g%3E%3C/svg%3E") !important;
        border-left: 1px solid rgba(255, 255, 255, 0.1) !important;
        margin: 0 -4px 0 8px !important;
        padding-left: 16px !important;
        opacity: 0.75 !important;
    }
    .choices__button:hover {
        opacity: 1 !important;
    }
    .choices__placeholder {
        color: #9ca3af !important;
        opacity: 1 !important;
    }
    /* Hide input when max items reached */
    .choices__list--multiple:has(.choices__item:nth-child(5)) + .choices__input--cloned {
        display: none !important;
        width: 0 !important;
        padding: 0 !important;
    }
</style>

<script>
    // Auto-resize textarea
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });

    // Prevent accidental navigation
    window.onbeforeunload = function() {
        if (document.querySelector('form').querySelector('[name="title"]').value || 
            document.querySelector('form').querySelector('[name="description"]').value ||
            document.querySelector('form').querySelector('[name="content"]').value) {
            return "You have unsaved changes. Are you sure you want to leave?";
        }
    };
</script>
@endsection 