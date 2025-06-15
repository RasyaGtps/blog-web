@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{ editModal: false, createModal: false, deleteModal: false, selectedUser: null }">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-white">Users Management</h1>
        <div class="flex items-center space-x-4">
            <button @click="createModal = true" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Create User
            </button>
            <form action="{{ route('admin.users') }}" method="GET" class="flex space-x-4">
                <div class="relative">
                    <input type="text" 
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search users..." 
                           class="bg-[#2f2f2f] text-gray-300 rounded-lg pl-10 pr-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <select name="role" 
                        onchange="this.form.submit()"
                        class="bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="verified" {{ request('role') === 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-[#242424] rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="text-left p-4 text-gray-400 font-medium">User</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Email</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Role</th>
                    <th class="text-left p-4 text-gray-400 font-medium">Joined</th>
                    <th class="text-right p-4 text-gray-400 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach($users as $user)
                <tr class="hover:bg-[#2f2f2f]">
                    <td class="p-4">
                        <div class="flex items-center space-x-3">
                            @if($user->avatar)
                                <img src="{{ asset('avatars/' . $user->avatar) }}" 
                                     alt="{{ $user->username }}" 
                                     class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-[#1a1a1a] flex items-center justify-center text-sm font-semibold text-gray-300 uppercase">
                                    {{ Str::substr($user->username, 0, 2) }}
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-white">{{ $user->name }}</div>
                                <div class="text-sm text-gray-400">{{ '@' . $user->username }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-gray-300">{{ $user->email }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                            {{ $user->role === 'admin' ? 'bg-purple-900/20 text-purple-400' : 
                               ($user->role === 'verified' ? 'bg-green-900/20 text-green-400' : 'bg-blue-900/20 text-blue-400') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end space-x-3">
                            <button @click="editModal = true; selectedUser = {{ $user }}" 
                                    class="text-gray-400 hover:text-blue-400">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.users.destroy', $user) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
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
        {{ $users->links() }}
    </div>

    <!-- Create User Modal -->
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
            <h2 class="text-xl font-bold text-white mb-4">Create New User</h2>
            <form action="{{ route('admin.users.store') }}" 
                  method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-400 mb-2">Name</label>
                        <input type="text" 
                               name="name" 
                               required
                               class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Username</label>
                        <input type="text" 
                               name="username" 
                               required
                               class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Email</label>
                        <input type="email" 
                               name="email" 
                               required
                               class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Password</label>
                        <input type="password" 
                               name="password" 
                               required
                               class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Role</label>
                        <select name="role" 
                                required
                                class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="user">User</option>
                            <option value="verified">Verified</option>
                            <option value="admin">Admin</option>
                        </select>
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
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
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
            <h2 class="text-xl font-bold text-white mb-4">Edit User</h2>
            <form :action="selectedUser ? `/admin/users/${selectedUser.id}` : ''" 
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
                               x-model="selectedUser.name"
                               class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Username</label>
                        <input type="text" 
                               name="username" 
                               x-model="selectedUser.username"
                               class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Email</label>
                        <input type="email" 
                               name="email" 
                               x-model="selectedUser.email"
                               class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Role</label>
                        <select name="role" 
                                x-model="selectedUser.role"
                                class="w-full bg-[#2f2f2f] text-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="user">User</option>
                            <option value="verified">Verified</option>
                            <option value="admin">Admin</option>
                        </select>
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
                this.$watch('selectedUser', (user) => {
                    if (user) {
                        this.$refs.editForm.action = `/admin/users/${user.id}`;
                    }
                });
            }
        }));
    });
</script>
@endpush

@endsection 