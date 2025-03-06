@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ editModal: false, deleteModal: false, commentModal: false, selectedArticle: null }">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                <i class="fas fa-newspaper text-gray-400"></i>
                Manajemen Artikel
            </h1>
            <p class="text-gray-400 mt-1">
                <i class="fas fa-file-alt mr-2"></i>
                Total Artikel: {{ $articles->total() }}
            </p>
        </div>
        <a href="{{ route('articles.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
            <i class="fas fa-plus"></i>
            <span>Tambah Artikel Baru</span>
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="bg-[#242424] rounded-lg shadow-lg p-6 mb-8">
        <form action="{{ route('admin.articles') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="relative">
                <input type="text" 
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari artikel..." 
                       class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <div class="relative">
                <select name="type" 
                        onchange="this.form.submit()"
                        class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg pl-10 pr-4 py-2 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Type</option>
                    <option value="free" {{ request('type') === 'free' ? 'selected' : '' }}>Free</option>
                    <option value="premium" {{ request('type') === 'premium' ? 'selected' : '' }}>Premium</option>
                </select>
                <i class="fas fa-filter absolute left-3 top-3 text-gray-400"></i>
            </div>
            <div class="relative">
                <select name="sort" 
                        onchange="this.form.submit()"
                        class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg pl-10 pr-4 py-2 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="most_viewed" {{ request('sort') === 'most_viewed' ? 'selected' : '' }}>Paling Banyak Dilihat</option>
                </select>
                <i class="fas fa-sort absolute left-3 top-3 text-gray-400"></i>
            </div>
        </form>
    </div>

    <!-- Articles Table -->
    <div class="bg-[#242424] rounded-lg shadow-lg overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="text-left p-4 text-gray-400 font-medium">Artikel</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Penulis</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Status</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Statistik</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Tanggal</th>
                    <th class="text-right p-4 text-gray-400 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($articles as $article)
                <tr class="hover:bg-[#2f2f2f] transition-colors">
                    <td class="p-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-12 h-12">
                                @if($article->cover_image)
                                    <img src="{{ $article->cover_image }}" 
                                         alt="{{ $article->title }}" 
                                         class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-[#1a1a1a] flex items-center justify-center">
                                        <i class="fas fa-newspaper text-gray-600 text-xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="font-medium text-white">{{ $article->title }}</div>
                                <div class="text-sm text-gray-400">{{ Str::limit($article->description, 60) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="flex items-center space-x-3">
                            @if($article->user->avatar)
                                <img src="{{ asset('avatars/' . $article->user->avatar) }}" 
                                     alt="{{ $article->user->username }}" 
                                     class="w-8 h-8 rounded-full object-cover">
                            @else
                                <div class="w-8 h-8 rounded-full bg-[#1a1a1a] flex items-center justify-center text-sm font-semibold text-gray-300 uppercase">
                                    {{ Str::substr($article->user->username, 0, 2) }}
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-white">{{ $article->user->name }}</div>
                                <div class="text-sm text-gray-400">{{ '@' . $article->user->username }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        @if($article->type === 'premium')
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-900/20 text-yellow-400">
                                Premium
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-900/20 text-green-400">
                                Free
                            </span>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="flex items-center space-x-4 text-sm text-gray-400">
                            <span class="flex items-center gap-1">
                                <i class="far fa-eye"></i>
                                {{ $article->views }}
                            </span>
                            <button @click="commentModal = true; selectedArticle = {{ $article->load('comments.user', 'comments.replies.user') }}" 
                                    class="flex items-center gap-1 hover:text-blue-400 transition-colors">
                                <i class="far fa-comment"></i>
                                {{ $article->comments->count() }}
                            </button>
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="text-sm text-gray-400">
                            <div>{{ \Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</div>
                            <div class="text-xs">{{ \Carbon\Carbon::parse($article->created_at)->format('H:i') }} WIB</div>
                        </div>
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('articles.show', $article) }}" 
                               class="text-gray-400 hover:text-white transition-colors"
                               title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('articles.edit', $article) }}" 
                               class="text-gray-400 hover:text-blue-400 transition-colors"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" 
                                  method="POST" 
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-gray-400 hover:text-red-400 transition-colors"
                                        title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="text-gray-400 text-6xl mb-4">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <h3 class="text-xl font-medium text-white mb-2">Tidak ada artikel</h3>
                            <p class="text-gray-400 mb-6">Belum ada artikel yang ditambahkan</p>
                            <a href="{{ route('articles.create') }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition-colors">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Artikel Baru</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $articles->links() }}
    </div>

    <!-- Comment Modal -->
    <div x-show="commentModal" 
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
         x-cloak>
        <div class="bg-[#242424] rounded-lg shadow-lg w-full max-w-4xl p-6" 
             @click.away="commentModal = false"
             x-data="{ activeTab: 'all' }">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white">Komentar Artikel</h2>
                <button @click="commentModal = false" class="text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-medium text-white mb-2" x-text="selectedArticle?.title"></h3>
                <p class="text-gray-400 text-sm" x-text="selectedArticle?.description"></p>
            </div>

            <!-- Comment Tabs -->
            <div class="flex space-x-4 mb-6">
                <button @click="activeTab = 'all'"
                        :class="{'text-blue-400 border-b-2 border-blue-400': activeTab === 'all',
                                'text-gray-400 hover:text-white': activeTab !== 'all'}"
                        class="pb-2">
                    Semua Komentar
                </button>
                <button @click="activeTab = 'parent'"
                        :class="{'text-blue-400 border-b-2 border-blue-400': activeTab === 'parent',
                                'text-gray-400 hover:text-white': activeTab !== 'parent'}"
                        class="pb-2">
                    Komentar Utama
                </button>
            </div>

            <!-- Comments List -->
            <div class="space-y-4 max-h-[60vh] overflow-y-auto">
                <template x-for="comment in selectedArticle?.comments" :key="comment.id">
                    <div x-show="activeTab === 'all' || (activeTab === 'parent' && !comment.parent_id)"
                         :class="{'ml-8': comment.parent_id}"
                         class="bg-[#2f2f2f] rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <template x-if="comment.user.avatar">
                                <img :src="'/avatars/' + comment.user.avatar" 
                                     :alt="comment.user.username"
                                     class="w-8 h-8 rounded-full object-cover">
                            </template>
                            <template x-if="!comment.user.avatar">
                                <div class="w-8 h-8 rounded-full bg-[#1a1a1a] flex items-center justify-center text-sm font-semibold text-gray-300 uppercase"
                                     x-text="comment.user.username.substring(0, 2)">
                                </div>
                            </template>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="font-medium text-white" x-text="comment.user.name"></span>
                                        <span class="text-sm text-gray-400" x-text="'@' + comment.user.username"></span>
                                    </div>
                                    <div class="text-xs text-gray-400" x-text="new Date(comment.created_at).toLocaleDateString()"></div>
                                </div>
                                <p class="text-gray-300 mt-2" x-text="comment.content"></p>
                                
                                <!-- Replies -->
                                <template x-if="comment.replies && comment.replies.length > 0">
                                    <div class="mt-4 space-y-3">
                                        <template x-for="reply in comment.replies" :key="reply.id">
                                            <div class="bg-[#242424] rounded-lg p-3">
                                                <div class="flex items-start space-x-3">
                                                    <template x-if="reply.user.avatar">
                                                        <img :src="'/avatars/' + reply.user.avatar" 
                                                             :alt="reply.user.username"
                                                             class="w-6 h-6 rounded-full object-cover">
                                                    </template>
                                                    <template x-if="!reply.user.avatar">
                                                        <div class="w-6 h-6 rounded-full bg-[#1a1a1a] flex items-center justify-center text-xs font-semibold text-gray-300 uppercase"
                                                             x-text="reply.user.username.substring(0, 2)">
                                                        </div>
                                                    </template>
                                                    <div class="flex-1">
                                                        <div class="flex items-center justify-between">
                                                            <div>
                                                                <span class="font-medium text-white" x-text="reply.user.name"></span>
                                                                <span class="text-xs text-gray-400" x-text="'@' + reply.user.username"></span>
                                                            </div>
                                                            <div class="text-xs text-gray-400" x-text="new Date(reply.created_at).toLocaleDateString()"></div>
                                                        </div>
                                                        <p class="text-gray-300 mt-1 text-sm" x-text="reply.content"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('editModal', () => ({
            init() {
                this.$watch('selectedArticle', (article) => {
                    if (article) {
                        this.$refs.editForm.action = `/admin/articles/${article.id}`;
                    }
                });
            }
        }));

        Alpine.data('deleteModal', () => ({
            init() {
                this.$watch('selectedArticle', (article) => {
                    if (article) {
                        this.$refs.deleteForm.action = `/admin/articles/${article.id}`;
                    }
                });
            }
        }));
    });
</script>
@endpush

@endsection