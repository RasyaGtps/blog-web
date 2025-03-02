@extends('layouts.app')

@section('content')
<div class="container max-w-4xl mx-auto px-4 py-8">
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6 space-y-8">
        <!-- Profile Picture Section -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Profile Picture</h2>
            <div class="flex items-start space-x-6">
                <div class="relative">
                    <img src="/avatars/{{ Auth::user()->avatar }}" 
                         alt="{{ Auth::user()->name }}" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-gray-200">
                </div>
                <div class="flex flex-col">
                    <form action="{{ route('profile.updateAvatar') }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                        @csrf
                        @method('PATCH')
                        <input type="file" 
                               id="avatar" 
                               name="avatar" 
                               class="hidden" 
                               accept="image/*"
                               onchange="document.getElementById('uploadBtn').classList.remove('hidden')">
                        <div>
                            <button type="button" 
                                    onclick="document.getElementById('avatar').click()" 
                                    class="text-blue-600 hover:text-blue-700 font-medium">
                                Upload a new avatar
                            </button>
                            <p class="text-sm text-gray-500">JPG, PNG, GIF up to 2MB</p>
                        </div>
                        <button id="uploadBtn" 
                                type="submit" 
                                class="hidden bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
            @error('avatar')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Profile Information -->
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', Auth::user()->name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       value="{{ old('username', Auth::user()->username) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('username')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', Auth::user()->email) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea id="bio" 
                          name="bio" 
                          rows="3"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('bio', Auth::user()->bio) }}</textarea>
                @error('bio')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection