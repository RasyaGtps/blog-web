@extends('layouts.admin')

@section('title', 'Membership Requests')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-[#2f2f2f] overflow-hidden shadow-sm rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-white">Permintaan Keanggotaan</h2>
            </div>

            @if($requests->isEmpty())
                <div class="text-gray-400 text-center py-8">
                    Belum ada permintaan keanggotaan baru
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-[#242424]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Pengguna
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Paket
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Tanggal Permintaan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#2f2f2f] divide-y divide-gray-700">
                            @foreach($requests as $request)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($request->user->avatar)
                                                <img src="/avatars/{{ $request->user->avatar }}" 
                                                     alt="{{ $request->user->username }}" 
                                                     class="w-8 h-8 rounded-full mr-3">
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-gray-600 flex items-center justify-center text-sm font-semibold text-gray-300 uppercase mr-3">
                                                    {{ Str::substr($request->user->username, 0, 2) }}
                                                </div>
                                            @endif
                                            <div>
                                                <div class="text-sm font-medium text-white">
                                                    {{ $request->user->username }}
                                                </div>
                                                <div class="text-sm text-gray-400">
                                                    {{ $request->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $request->type === 'premium' ? 'bg-purple-900 text-purple-200' : 'bg-blue-900 text-blue-200' }}">
                                            {{ $request->type === 'premium' ? 'Premium' : 'Dasar' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        {{ $request->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-900 text-yellow-200">
                                            Menunggu
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <form action="{{ route('admin.memberships.approve', $request->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition-colors">
                                                    Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.memberships.reject', $request->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition-colors">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($requests->hasPages())
                    <div class="mt-4">
                        {{ $requests->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection 