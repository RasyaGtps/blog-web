@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                <i class="fas fa-user-edit text-gray-400"></i>
                Edit User
            </h1>
            <p class="text-gray-400 mt-1">
                <i class="fas fa-info-circle mr-2"></i>
                Edit informasi user {{ $user->name }}
            </p>
        </div>
        <a href="{{ route('admin.users') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <div class="bg-[#242424] rounded-lg shadow-lg p-6">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data"
              x-data="{ 
                membership: '{{ old('membership', $user->membership) }}',
                updateExpirationField() {
                    if (this.membership === 'free') {
                        $refs.expirationDate.disabled = true;
                        $refs.expirationDate.value = '';
                    } else {
                        $refs.expirationDate.disabled = false;
                        if (!$refs.expirationDate.value) {
                            let date = new Date();
                            date.setMonth(date.getMonth() + 1);
                            $refs.expirationDate.value = date.toISOString().split('T')[0];
                        }
                    }
                }
              }"
              x-init="updateExpirationField()">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Avatar -->
                <div class="col-span-2">
                    <label class="block text-gray-400 mb-2">Avatar</label>
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            <img id="avatar-preview" 
                                 class="h-16 w-16 object-cover rounded-full"
                                 src="{{ $user->avatar ? asset('avatars/' . $user->avatar) : asset('images/default-avatar.png') }}" 
                                 alt="{{ $user->name }}" />
                        </div>
                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input type="file" 
                                   name="avatar"
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-400
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100"
                                   onchange="document.getElementById('avatar-preview').src = window.URL.createObjectURL(this.files[0])" />
                        </label>
                    </div>
                    @error('avatar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-gray-400 mb-2" for="name">Nama Lengkap</label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           value="{{ old('name', $user->name) }}"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div>
                    <label class="block text-gray-400 mb-2" for="username">Username</label>
                    <input type="text" 
                           name="username" 
                           id="username"
                           value="{{ old('username', $user->username) }}"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-400 mb-2" for="email">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           value="{{ old('email', $user->email) }}"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-400 mb-2" for="password">Password</label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Biarkan kosong jika tidak ingin mengubah password">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div class="col-span-2">
                    <label class="block text-gray-400 mb-2" for="role">Role</label>
                    <select name="role" 
                            id="role"
                            class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="verified" {{ old('role', $user->role) === 'verified' ? 'selected' : '' }}>Verified</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Membership -->
                <div class="col-span-2">
                    <label class="block text-gray-400 mb-2" for="membership">Membership</label>
                    <select name="membership" 
                            id="membership"
                            x-model="membership"
                            @change="updateExpirationField()"
                            class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="free" {{ old('membership', $user->membership) === 'free' ? 'selected' : '' }}>Free</option>
                        <option value="basic" {{ old('membership', $user->membership) === 'basic' ? 'selected' : '' }}>Basic</option>
                        <option value="premium" {{ old('membership', $user->membership) === 'premium' ? 'selected' : '' }}>Premium</option>
                    </select>
                    @error('membership')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Membership Expiration -->
                <div class="col-span-2">
                    <label class="block text-gray-400 mb-2" for="membership_expires_at">Membership Expiration Date</label>
                    <input type="date" 
                           name="membership_expires_at" 
                           id="membership_expires_at"
                           x-ref="expirationDate"
                           value="{{ old('membership_expires_at', $user->membership_expires_at ? $user->membership_expires_at->format('Y-m-d') : '') }}"
                           class="w-full bg-[#2f2f2f] text-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('membership_expires_at')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="fas fa-save"></i>
                    <span>Update User</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 