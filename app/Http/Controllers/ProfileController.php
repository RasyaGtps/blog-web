<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Show user's public profile
     */
    public function show($username)
    {
        $user = User::where('username', $username)
            ->withCount(['followers', 'following', 'articles'])
            ->firstOrFail();

        $articles = $user->articles()
            ->latest()
            ->paginate(9);

        return view('profile.show', [
            'user' => $user,
            'articles' => $articles
        ]);
    }

    /**
     * Show the profile settings page
     */
    public function index()
    {
        $user = Auth::user();
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        
        return view('settings.profile', compact('user', 'followersCount', 'followingCount'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $followersCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        
        return view('settings.profile', compact('user', 'followersCount', 'followingCount'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:1000'
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update user's avatar
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        // Delete old avatar if exists
        if ($user->avatar && file_exists(public_path('avatars/' . $user->avatar))) {
            unlink(public_path('avatars/' . $user->avatar));
        }

        $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('avatars'), $avatarName);

        $user->update(['avatar' => $avatarName]);

        return back()->with('success', 'Avatar berhasil diperbarui.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function follow(User $user)
    {
        auth()->user()->following()->attach($user->id);
        return back()->with('success', 'You are now following ' . $user->name);
    }

    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);
        return back()->with('success', 'You have unfollowed ' . $user->name);
    }

    public function followers(User $user)
    {
        $followers = $user->followers()->paginate(20);
        return view('profile.followers', compact('user', 'followers'));
    }

    public function following(User $user)
    {
        $following = $user->following()->paginate(20);
        return view('profile.following', compact('user', 'following'));
    }

    // API Methods
    public function apiShow(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'user' => $user,
            'followers_count' => $user->followers()->count(),
            'following_count' => $user->following()->count()
        ]);
    }

    public function apiUpdate(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }

    public function apiUpdateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = $request->user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return response()->json([
            'message' => 'Avatar updated successfully',
            'avatar_url' => Storage::url($path)
        ]);
    }

    public function apiFollow($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $follower = auth()->user();
        $follower->following()->attach($user->id);

        return response()->json([
            'message' => 'Successfully followed user',
            'following_count' => $follower->following()->count()
        ]);
    }

    public function apiUnfollow($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $follower = auth()->user();
        $follower->following()->detach($user->id);

        return response()->json([
            'message' => 'Successfully unfollowed user',
            'following_count' => $follower->following()->count()
        ]);
    }

    public function apiFollowers($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        
        // Pastikan user yang ditemukan
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        
        // Ambil data follower dengan pagination
        $followers = $user->followers()->paginate(20);
        
        return response()->json([
            'username' => $user->username,
            'name' => $user->name,
            'followers_count' => $user->followers()->count(),
            'followers' => $followers
        ]);
    }

    public function apiFollowing($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        
        // Pastikan user yang ditemukan
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        
        // Ambil data following dengan pagination
        $following = $user->following()->paginate(20);
        
        return response()->json([
            'username' => $user->username,
            'name' => $user->name,
            'following_count' => $user->following()->count(),
            'following' => $following
        ]);
    }

    public function adminShow()
    {
        $user = auth()->user()
            ->loadCount(['articles', 'followers', 'following']);
            
        $articles = $user->articles()
            ->with('comments')
            ->latest()
            ->paginate(6);
        
        return view('admin.profile', compact('user', 'articles'));
    }
}