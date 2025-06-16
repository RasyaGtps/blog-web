<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['articles', 'comments'])
            ->when(request('search'), function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%')
                      ->orWhere('username', 'like', '%' . request('search') . '%')
                      ->orWhere('email', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('role'), function ($query) {
                $query->where('role', request('role'));
            })
            ->when(request('sort'), function ($query) {
                match(request('sort')) {
                    'newest' => $query->latest(),
                    'oldest' => $query->oldest(),
                    'most_articles' => $query->orderByDesc('articles_count'),
                    'most_comments' => $query->orderByDesc('comments_count'),
                    default => $query->latest()
                };
            }, function ($query) {
                $query->latest();
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'role' => ['required', 'in:user,admin,verified'],
            'membership' => ['required', 'in:free,basic,premium'],
            'membership_expires_at' => [
                'nullable',
                'date',
                'required_if:membership,basic,premium',
                'after:today'
            ],
            'avatar' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = basename($avatar);
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified'] = true;
        $validated['online_status'] = false;
        $validated['last_seen'] = now();

        // Set membership expiration
        if ($validated['membership'] === 'free') {
            $validated['membership_expires_at'] = null;
        } elseif (!isset($validated['membership_expires_at'])) {
            $validated['membership_expires_at'] = now()->addMonth();
        }

        User::create($validated);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:user,admin,verified'],
            'membership' => ['required', 'in:free,basic,premium'],
            'membership_expires_at' => [
                'nullable',
                'date',
                'required_if:membership,basic,premium',
                'after:today'
            ],
            'avatar' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = basename($avatar);
        }

        // Set membership expiration
        if ($validated['membership'] === 'free') {
            $validated['membership_expires_at'] = null;
        } elseif (!isset($validated['membership_expires_at'])) {
            $validated['membership_expires_at'] = now()->addMonth();
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
        }

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dihapus');
    }
} 