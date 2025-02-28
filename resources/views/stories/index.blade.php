<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Stories - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    @vite('resources/css/app.css')
</head>
<body class="bg-[#FDF6F0]">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        @include('layouts.navigation')
    </div>

    <div class="container max-w-[1200px] mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 flex items-center justify-center gap-3">
                <i class="fas fa-book-reader"></i>
                Our Stories
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover amazing stories from our community of writers. Get inspired, learn something new, or just enjoy a good read.
            </p>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($articles as $article)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-3">
                            <a href="{{ route('articles.show', $article) }}" 
                               class="text-black hover:text-gray-700">
                                {{ $article->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $article->content }}
                        </p>
                        
                        <!-- Article Meta -->
                        <div class="flex items-center justify-between text-sm text-gray-500 mt-4 pt-4 border-t">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user-circle"></i>
                                <span>{{ $article->user->name }}</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="flex items-center gap-1">
                                    <i class="far fa-eye"></i>
                                    {{ $article->views }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <i class="far fa-comment"></i>
                                    {{ $article->comments->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">No stories published yet.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="mt-8">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</body>
</html> 