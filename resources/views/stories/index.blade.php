<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Kami - ByRead</title>
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
                @auth
                    @if(Auth::user()->membership === 'free')
                        <span class="text-yellow-600">✨</span>
                        <span>Dapatkan akses tanpa batas ke konten terbaik ByRead mulai dari Rp 29K/bulan.</span>
                        <a href="{{ route('membership.index') }}" class="font-semibold underline hover:text-gray-600">
                            Jadi Anggota
                        </a>
                    @elseif(Auth::user()->membership === 'basic')
                        <span class="text-yellow-600">✨</span>
                        <span>Terima kasih telah bergabung sebagai member Paket Dasar!</span>
                    @elseif(Auth::user()->membership === 'premium')
                        <span class="text-yellow-600">✨</span>
                        <span>Terima kasih telah bergabung sebagai member Premium!</span>
                    @endif
                @else
                    <span class="text-yellow-600">✨</span>
                    <span>Dapatkan akses tanpa batas ke konten terbaik ByRead mulai dari Rp 29K/bulan.</span>
                    <a href="{{ route('membership.index') }}" class="font-semibold underline hover:text-gray-600">
                        Jadi Anggota
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-[1200px] mx-auto px-4 py-8">
        <!-- Categories/Tags -->
        <div class="flex items-center gap-6 border-b border-gray-200 pb-4 mb-8 overflow-x-auto">
            <a href="{{ route('stories.index') }}" class="text-sm font-medium whitespace-nowrap {{ !request('tag') && !request('filter') ? 'text-black' : 'text-gray-500 hover:text-black' }}">
                Untuk Anda
            </a>
            @auth
                <a href="{{ route('stories.index', ['filter' => 'following']) }}" 
                   class="text-sm font-medium whitespace-nowrap {{ request('filter') === 'following' ? 'text-black' : 'text-gray-500 hover:text-black' }}">
                    Diikuti
                </a>
            @endauth
            @if(isset($tags) && $tags->count() > 0)
                @foreach($tags as $tag)
                    <a href="{{ route('stories.index', ['tag' => $tag->name]) }}" 
                       class="text-sm font-medium whitespace-nowrap {{ request('tag') === $tag->name ? 'text-black' : 'text-gray-500 hover:text-black' }}">
                        {{ $tag->name }}
                    </a>
                @endforeach
            @endif
        </div>

        <!-- Articles List -->
        <div class="grid grid-cols-12 gap-8">
            <!-- Main Articles Column -->
            <div class="col-span-12 md:col-span-8">
                @forelse($articles as $article)
                <article class="mb-8 pb-8 border-b border-gray-200">
                    <div class="flex items-center gap-2 mb-3">
                        @if($article->user->avatar)
                        <img src="/avatars/{{ $article->user->avatar }}"
                            alt="{{ $article->user->username }}"
                            class="w-6 h-6 rounded-full">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->username) }}"
                            alt="{{ $article->user->username }}"
                            class="w-6 h-6 rounded-full">
                        @endif
                        <a href="{{ route('profile.show', $article->user->username) }}" class="text-sm">{{ $article->user->username }}</a>
                        @if($article->user->role === 'verified')
                        <span class="text-sm text-blue-600">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        @endif
                        @if($article->user->role === 'admin')
                        <span class="text-sm text-purple-600" title="Developer">
                            <i class="fas fa-code"></i>
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
                                    @if($article->type === 'premium')
                                        <span class="inline-flex items-center justify-center ml-2 px-1.5 py-0.5 bg-yellow-100 rounded text-yellow-600 text-sm" title="Premium Article">
                                            <i class="fas fa-crown"></i>
                                        </span>
                                    @endif
                                </a>
                            </h2>
                            <p class="text-gray-600 mb-3 line-clamp-2 text-base">
                                {{ $article->description }}
                            </p>
                            <div class="flex items-center gap-4 text-sm">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($article->tags as $tag)
                                        <a href="{{ route('stories.index', ['tag' => $tag->name]) }}" 
                                           class="bg-gray-100 px-3 py-1 rounded-full text-gray-600 text-sm hover:bg-gray-200 transition-colors">
                                            #{{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <span class="text-gray-500">{{ $article->read_time ?? '5' }} min read</span>
                                <span class="flex items-center gap-1 text-gray-500">
                                    <i class="far fa-eye"></i>
                                    {{ $article->views }}
                                </span>
                                <span class="flex items-center gap-1 text-gray-500">
                                    <i class="far fa-comment"></i>
                                    {{ $article->comments->count() }}
                                </span>
                                <span class="flex items-center gap-1 text-gray-500">
                                    <i class="far fa-heart"></i>
                                    {{ $article->likes()->count() }}
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
                    @if(request('filter') === 'following')
                        <i class="fas fa-users text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Belum ada artikel dari penulis yang Anda ikuti.</p>
                        @guest
                            <p class="text-gray-500 mt-2">
                                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> untuk mulai mengikuti penulis.
                            </p>
                        @endguest
                    @else
                        <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Belum ada artikel yang dipublikasikan.</p>
                    @endif
                </div>
                @endforelse

                <!-- Pagination -->
                @if($articles->hasPages())
                <div class="mt-8">
                    {{ $articles->appends(request()->query())->links() }}
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="hidden md:block col-span-4">
                <div class="sticky top-4">
                    <div class="bg-[#FDF6F0] rounded-lg p-6 mb-6">
                        <h3 class="font-bold mb-4">Artikel Pilihan</h3>
                        <div class="space-y-4">
                            @foreach($randomArticles as $article)
                            <div>
                                <a href="{{ route('articles.show', $article) }}" class="block">
                                    <h4 class="text-sm font-medium hover:text-gray-600 line-clamp-2 mb-2">
                                        {{ $article->title }}
                                        @if($article->type === 'premium')
                                            <span class="inline-flex items-center justify-center ml-1 px-1 py-0.5 bg-yellow-100 rounded text-yellow-600" title="Premium Article">
                                                <i class="fas fa-crown text-[10px]"></i>
                                            </span>
                                        @endif
                                    </h4>
                                </a>
                                <div class="flex items-center gap-2">
                                    @if($article->user->avatar)
                                        <img src="/avatars/{{ $article->user->avatar }}" 
                                             alt="{{ $article->user->username }}" 
                                             class="w-6 h-6 rounded-full object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->user->username) }}" 
                                             alt="{{ $article->user->username }}" 
                                             class="w-6 h-6 rounded-full">
                                    @endif
                                    <a href="{{ route('profile.show', $article->user->username) }}" 
                                       class="text-sm text-gray-600 hover:text-gray-800">
                                        {{ $article->user->username }}
                                    </a>
                                    @if($article->user->role === 'verified')
                                        <span class="text-blue-600" title="Verified">
                                            <i class="fas fa-check-circle text-xs"></i>
                                        </span>
                                    @endif
                                    @if($article->user->role === 'admin')
                                        <span class="text-purple-600" title="Developer">
                                            <i class="fas fa-code text-xs"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-bold mb-4">Topik yang Direkomendasikan</h3>
                        <div class="flex flex-wrap gap-2">
                            @if(isset($tags) && $tags->count() > 0)
                            @foreach($tags as $tag)
                            <a href="{{ route('stories.index', ['tag' => $tag->name]) }}" 
                               class="inline-flex items-center px-3 py-1 rounded-full text-sm {{ request('tag') === $tag->name ? 'bg-gray-800 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-800' }} transition-colors">
                                <span class="{{ request('tag') === $tag->name ? 'text-gray-300' : 'text-gray-600' }}">#</span>
                                <span>{{ $tag->name }}</span>
                            </a>
                            @endforeach
                            @else
                            <span class="text-gray-500 text-sm">Belum ada topik tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>