<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Cerita Baru - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
    @vite('resources/css/app.css')
    <style>
        .choices {
            margin-bottom: 0 !important;
        }
        .choices__inner {
            background: white !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 0.375rem !important;
            min-height: 42px !important;
            padding: 6px 8px !important;
        }
        .choices__input {
            background: white !important;
            color: #1f2937 !important;
        }
        .choices__list--dropdown {
            background: white !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 0.375rem !important;
            margin-top: 2px !important;
        }
        .choices__list--dropdown .choices__item {
            color: #1f2937 !important;
            padding: 8px 10px !important;
        }
        .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background: #f3f4f6 !important;
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
            color: #6b7280 !important;
            opacity: 1 !important;
        }
        /* Hide input when max items reached */
        .choices__list--multiple:has(.choices__item:nth-child(5)) + .choices__input--cloned {
            display: none !important;
            width: 0 !important;
            padding: 0 !important;
        }
    </style>
</head>

<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        @include('layouts.navigation')
    </div>

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

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Short description</label>
                    <textarea name="description" 
                              id="description"
                              rows="3"
                              class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400"
                              placeholder="Write a short description of your story..."
                              required>{{ old('description') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">A brief summary that will appear under your story title</p>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tags (max 5)</label>
                    <div class="relative">
                        <select name="tags[]" id="tags" multiple class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:border-gray-400" x-data="{}" x-init="() => { choices = new Choices($el, { removeItems: true, removeItemButton: true, maxItemCount: 5, placeholder: true, placeholderValue: 'Select up to 5 tags', position: 'bottom', searchEnabled: true, searchChoices: true, hideSelected: true, renderChoiceLimit: -1, addItemFilter: function() { return this.getValue(true).length < 5; }, maxItemText: () => '' }); choices.passedElement.element.addEventListener('addItem', function() { if (choices.getValue(true).length >= 5) { const input = document.querySelector('.choices__input--cloned'); if (input) input.placeholder = ''; } }); choices.passedElement.element.addEventListener('removeItem', function() { const input = document.querySelector('.choices__input--cloned'); if (input && choices.getValue(true).length < 5) input.placeholder = 'Select up to 5 tags'; }); }">@foreach($tags as $tag)<option value="{{ $tag->id }}">{{ $tag->name }}</option>@endforeach</select>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Choose up to 5 tags that best describe your story</p>
                    @error('tags')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Article Type (for verified users ) -->
                @if(auth()->user()->role === 'verified')
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Article Type</label>
                        <div class="flex gap-4" x-data="{ selectedType: '{{ old('type', 'free') }}' }">
                            <!-- Free Option -->
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" 
                                       name="type" 
                                       value="free" 
                                       x-model="selectedType"
                                       class="hidden">
                                <div class="border rounded-lg p-4 transition-all duration-300 ease-in-out"
                                     :class="{
                                         'bg-green-50 border-green-500 shadow-sm': selectedType === 'free',
                                         'bg-gray-50 border-gray-200 opacity-40': selectedType === 'premium'
                                     }">
                                    <div class="flex items-center justify-center gap-3">
                                        <i class="fas fa-unlock text-lg"
                                           :class="selectedType === 'free' ? 'text-green-600' : 'text-gray-400'"></i>
                                        <span class="font-medium" :class="selectedType === 'free' ? 'text-green-700' : 'text-gray-500'">Free</span>
                                    </div>
                                </div>
                            </label>
                            
                            <!-- Premium Option -->
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" 
                                       name="type" 
                                       value="premium" 
                                       x-model="selectedType"
                                       class="hidden">
                                <div class="border rounded-lg p-4 transition-all duration-300 ease-in-out"
                                     :class="{
                                         'bg-yellow-50 border-yellow-500 shadow-sm': selectedType === 'premium',
                                         'bg-gray-50 border-gray-200 opacity-40': selectedType === 'free'
                                     }">
                                    <div class="flex items-center justify-center gap-3">
                                        <i class="fas fa-star text-lg"
                                           :class="selectedType === 'premium' ? 'text-yellow-600' : 'text-gray-400'"></i>
                                        <span class="font-medium" :class="selectedType === 'premium' ? 'text-yellow-700' : 'text-gray-500'">Premium</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

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

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
</body>

</html>