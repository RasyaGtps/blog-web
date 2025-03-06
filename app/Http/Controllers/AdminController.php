<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get statistics
        $totalUsers = User::count();
        $totalArticles = Article::count();
        $newUsersToday = User::whereDate('created_at', today())->count();
        $newArticlesToday = Article::whereDate('created_at', today())->count();

        // Get user roles distribution
        $userRoles = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->get();

        // Get membership distribution
        $memberships = User::select('membership', DB::raw('count(*) as count'))
            ->groupBy('membership')
            ->get();

        // Get latest users
        $latestUsers = User::latest()
            ->take(5)
            ->get();

        // Get latest articles
        $latestArticles = Article::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalArticles',
            'newUsersToday',
            'newArticlesToday',
            'userRoles',
            'memberships',
            'latestUsers',
            'latestArticles'
        ));
    }

    public function users()
    {
        $users = User::withCount(['articles', 'followers', 'following'])
            ->latest()
            ->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function articles()
    {
        $articles = Article::with('user')
            ->withCount('comments')
            ->latest()
            ->paginate(10);

        return view('admin.articles', compact('articles'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:user,admin,verified'
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('success', 'User role updated successfully.');
    }

    public function updateUserMembership(Request $request, User $user)
    {
        $validated = $request->validate([
            'membership' => 'required|in:free,basic,premium',
            'expires_at' => 'nullable|date'
        ]);

        $user->update([
            'membership' => $validated['membership'],
            'membership_expires_at' => $validated['expires_at']
        ]);

        return back()->with('success', 'User membership updated successfully.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function deleteArticle(Article $article)
    {
        $article->delete();
        return back()->with('success', 'Article deleted successfully.');
    }
} 