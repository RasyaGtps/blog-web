<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show($id)
    {
        try {
            $user = User::with(['articles', 'followers', 'following'])->findOrFail($id);
            $followersCount = $user->followers()->count();
            $followingCount = $user->following()->count();
            $articlesCount = $user->articles()->count();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'user' => $user,
                    'stats' => [
                        'followers_count' => $followersCount,
                        'following_count' => $followingCount,
                        'articles_count' => $articlesCount
                    ]
                ]
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function me()
    {
        $user = auth()->user();
        $user->loadCount(['followers', 'following', 'articles']);

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'bio' => $user->bio,
                'followers_count' => $user->followers_count,
                'following_count' => $user->following_count,
                'articles_count' => $user->articles_count
            ]
        ]);
    }

    // API untuk mendapatkan profil user berdasarkan username
    public function getUserByUsername($username)
    {
        $user = User::where('username', $username)
            ->withCount(['followers', 'following', 'articles'])
            ->first();
            
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        
        return response()->json([
            'user' => $user
        ]);
    }
    
    // API untuk memperbarui profil user
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500'
        ]);

        $user = auth()->user();
        $user->update($request->only(['name', 'bio']));

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'bio' => $user->bio,
                'avatar' => $user->avatar
            ]
        ]);
    }

    public function updateAvatar(Request $request)
    {
        // Basic check for file presence
        if (!$request->hasFile('avatar')) {
            return response()->json([
                'status' => false,
                'message' => 'File tidak ditemukan'
            ], 400);
        }

        // Get the file
        $file = $request->file('avatar');
        
        // Validate file type
        if (!in_array($file->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
            return response()->json([
                'status' => false,
                'message' => 'File harus berupa gambar (JPG, JPEG, PNG)'
            ], 400);
        }

        // Validate file size (max 2MB)
        if ($file->getSize() > 2048 * 1024) {
            return response()->json([
                'status' => false,
                'message' => 'Ukuran file maksimal 2MB'
            ], 400);
        }

        try {
            $user = auth()->user();

            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Save new avatar
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('avatars', $fileName, 'public');
            
            $user->avatar = $path;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Avatar berhasil diupdate',
                'data' => [
                    'avatar_url' => Storage::url($path)
                ]
            ]);

        } catch (\Exception $e) {
            // Delete uploaded file if there's an error
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengupdate avatar'
            ], 500);
        }
    }

    public function follow($username)
    {
        $userToFollow = User::where('username', $username)->firstOrFail();
        
        if (auth()->id() === $userToFollow->id) {
            return response()->json(['message' => 'You cannot follow yourself'], 400);
        }

        auth()->user()->following()->attach($userToFollow->id);

        return response()->json(['message' => 'User followed successfully']);
    }

    public function unfollow($username)
    {
        $userToUnfollow = User::where('username', $username)->firstOrFail();
        auth()->user()->following()->detach($userToUnfollow->id);

        return response()->json(['message' => 'User unfollowed successfully']);
    }

    public function followers($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $followers = $user->followers()
            ->select('users.id', 'users.name', 'users.username', 'users.avatar')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data followers berhasil diambil',
            'data' => [
                'profile' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'avatar' => $user->avatar
                ],
                'total_followers' => $followers->count(),
                'followers' => $followers ?: []
            ]
        ]);
    }

    public function following($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $following = $user->following()
            ->select('users.id', 'users.name', 'users.username', 'users.avatar')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data following berhasil diambil',
            'data' => [
                'profile' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'avatar' => $user->avatar
                ],
                'total_following' => $following->count(),
                'following' => $following ?: []
            ]
        ]);
    }
} 