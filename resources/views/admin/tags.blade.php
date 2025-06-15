@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ createModal: false, editModal: false, selectedTag: null }">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-white">Tags Management</h1>
        <div class="flex items-center space-x-4">
            <button @click="createModal = true" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Create Tag
            </button>
            <form action="{{ route('admin.tags') }}" method="GET" class="flex space-x-4">
                <div class="relative">
                    <input type="text" 
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search tags..." 
                           class="bg-[#2f2f2f] text-gray-300 rounded-lg pl-10 pr-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </form>
        </div>
    </div>

    <!-- Tags Table -->
    <div class="bg-[#242424] rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="text-left p-4 text-gray-400 font-medium">Name</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Slug</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Articles</th>
                    <th class="text-right p-4 text-gray-400 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach($tags as $tag)
                <tr class="hover:bg-[#2f2f2f]">
                    <td class="p-4">
                        <div class="font-medium text-white">{{ $tag->name }}</div>
                    </td>
                    <td class="p-4 text-gray-300">{{ $tag->slug }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 bg-[#2f2f2f] text-gray-300 rounded-full text-sm">
                            {{ $tag->articles_count }}
                        </span>
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end space-x-3">
                            <button @click="editModal = true; selectedTag = {{ $tag }}" 
                                    class="text-gray-400 hover:text-blue-400">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.tags.destroy', $tag) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this tag? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-gray-400 hover:text-red-400">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $tags->links() }}
    </div>

    <!-- Create Tag Modal -->
    <div x-show="createModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-[#242424] rounded-lg shadow-lg w-full max-w-md p-6" @click.away="createModal = false">
            <h2 class="text-xl font-bold text-white mb-4">Create New Tag</h2>
            <form action="{{ route('admin.tags.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-400 mb-2">Name</label>
                        <input type="text" 
                               name="name" 
                               required
                               class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" 
                            @click="createModal = false"
                            class="px-4 py-2 text-gray-400 hover:text-white">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Create Tag
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Tag Modal -->
    <div x-show="editModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-[#242424] rounded-lg shadow-lg w-full max-w-md p-6" @click.away="editModal = false">
            <h2 class="text-xl font-bold text-white mb-4">Edit Tag</h2>
            <form :action="selectedTag ? `/admin/tags/${selectedTag.id}` : ''" 
                  method="POST"
                  x-ref="editForm"
                  @submit.prevent="$refs.editForm.submit(); editModal = false;">
                @csrf
                @method('PATCH')
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-400 mb-2">Name</label>
                        <input type="text" 
                               name="name" 
                               x-model="selectedTag.name"
                               required
                               class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" 
                            @click="editModal = false"
                            class="px-4 py-2 text-gray-400 hover:text-white">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('editModal', () => ({
            init() {
                this.$watch('selectedTag', (tag) => {
                    if (tag) {
                        this.$refs.editForm.action = `/admin/tags/${tag.id}`;
                    }
                });
            }
        }));
    });
</script>
@endpush

@endsection 