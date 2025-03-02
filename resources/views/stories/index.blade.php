<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Stories - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    @vite('resources/css/app.css')
</head>
<body class="bg-white">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        @include('layouts.navigation')
    </div>

    <!-- Premium Banner -->
    <div class="bg-[#FDF6F0] border-b border-gray-200">
        <div class="max-w-[1200px] mx-auto px-4 py-3">
            <div class="flex items-center justify-center gap-2 text-sm">
                <span class="text-yellow-600">✨</span>
                <span>Get unlimited access to the best of ByRead for less than $1/week.</span>
                <a href="{{ route('membership.index') }}" class="font-semibold underline hover:text-gray-600">
                    Become a member
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-[1200px] mx-auto px-4 py-8">
        <!-- Categories/Tags -->
        <div class="flex items-center gap-6 border-b border-gray-200 pb-4 mb-8 overflow-x-auto">
            <a href="#" class="text-sm font-medium whitespace-nowrap {{ request()->is('stories') ? 'text-black' : 'text-gray-500 hover:text-black' }}">
                For you
            </a>
            <a href="#" class="text-sm font-medium whitespace-nowrap text-gray-500 hover:text-black">
                Following
            </a>
            <a href="#" class="text-sm font-medium whitespace-nowrap text-gray-500 hover:text-black">
                Technology
            </a>
            <a href="#" class="text-sm font-medium whitespace-nowrap text-gray-500 hover:text-black">
                Data Science
            </a>
            <a href="#" class="text-sm font-medium whitespace-nowrap text-gray-500 hover:text-black">
                Programming
            </a>
            <a href="#" class="text-sm font-medium whitespace-nowrap text-gray-500 hover:text-black">
                Writing
            </a>
        </div>

        <!-- Articles List -->
        <div class="grid grid-cols-12 gap-8">
            <!-- Main Articles Column -->
            <div class="col-span-12 md:col-span-8">
                @forelse($articles as $article)
                    <article class="mb-8 pb-8 border-b border-gray-200">
                        <div class="flex items-center gap-2 mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->username) }}" 
                                 alt="{{ $article->user->username }}" 
                                 class="w-6 h-6 rounded-full">
                            <span class="text-sm">{{ $article->user->username }}</span>
                            @if($article->user->role === 'verified')
                                <span class="text-sm text-blue-600">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                            @endif
                            <span class="text-gray-500 text-sm">· {{ $article->created_at->format('M d') }}</span>
                        </div>
                        
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold mb-2 font-serif">
                                    <a href="{{ route('articles.show', $article) }}" 
                                       class="text-black hover:text-gray-700">
                                        {{ $article->title }}
                                    </a>
                                </h2>
                                <p class="text-gray-600 mb-3 line-clamp-2 text-base">
                                    {{ $article->description }}
                                </p>
                                <div class="flex items-center gap-4 text-sm">
                                    <span class="bg-gray-100 px-3 py-1 rounded-full text-gray-600">
                                        {{ $article->category ?? 'General' }}
                                    </span>
                                    <span class="text-gray-500">{{ $article->read_time ?? '5' }} min read</span>
                                    <span class="flex items-center gap-1 text-gray-500">
                                        <i class="far fa-eye"></i>
                                        {{ $article->views }}
                                    </span>
                                    <span class="flex items-center gap-1 text-gray-500">
                                        <i class="far fa-comment"></i>
                                        {{ $article->comments->count() }}
                                    </span>
                                </div>
                            </div>
                            @if($article->image)
                                <img src="{{ $article->image }}" 
                                     alt="{{ $article->title }}" 
                                     class="w-32 h-32 object-cover rounded">
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="text-center py-12">
                        <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">No stories published yet.</p>
                    </div>
                @endforelse

                <!-- Pagination -->
                @if($articles->hasPages())
                    <div class="mt-8">
                        {{ $articles->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="hidden md:block col-span-4">
                <div class="sticky top-4">
                    <div class="bg-[#FDF6F0] rounded-lg p-6 mb-6">
                        <h3 class="font-bold mb-4">Staff Picks</h3>
                        <div class="space-y-4">
                            @foreach(range(1, 3) as $index)
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <img src="https://ui-avatars.com/api/?name=Staff" 
                                             alt="Staff" 
                                             class="w-6 h-6 rounded-full">
                                        <span class="text-sm">Featured Writer</span>
                                    </div>
                                    <a href="#" class="text-sm font-medium hover:text-gray-600">
                                        How to Write Better Articles
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-bold mb-4">Recommended topics</h3>
                        <div class="flex flex-wrap gap-2">
                            @if(isset($tags) && $tags->count() > 0)
                                @foreach($tags as $tag)
                                    <a href="#" class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-200 hover:bg-gray-300 transition-colors">
                                        <span class="text-gray-600">#</span>
                                        <span class="text-gray-800">{{ $tag->name }}</span>
                                    </a>
                                @endforeach
                            @else
                                <span class="text-gray-500 text-sm">No topics available</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 