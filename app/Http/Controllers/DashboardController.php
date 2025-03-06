<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the dashboard with user's articles.
     */
    public function index(Request $request)
    {
        // Jika user adalah admin
        if (auth()->user()->role === 'admin') {
            // Data untuk admin dashboard
            $totalUsers = User::count();
            $newUsersToday = User::whereDate('created_at', today())->count();
            $totalArticles = Article::count();
            $newArticlesToday = Article::whereDate('created_at', today())->count();
            
            // Statistik role pengguna
            $userRoles = DB::table('users')
                ->select('role', DB::raw('count(*) as count'))
                ->whereNotNull('role')
                ->groupBy('role')
                ->get();
            
            // Statistik membership
            $memberships = DB::table('users')
                ->select('membership', DB::raw('count(*) as count'))
                ->whereNotNull('membership')
                ->groupBy('membership')
                ->get();
            
            // User dan artikel terbaru
            $latestUsers = User::latest()->take(5)->get();
            $latestArticles = Article::with('user')
                ->latest()
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'totalUsers',
                'newUsersToday',
                'totalArticles',
                'newArticlesToday',
                'userRoles',
                'memberships',
                'latestUsers',
                'latestArticles'
            ));
        }

        // Untuk user biasa
        $articles = Article::where('user_id', auth()->id())
            ->with('comments')
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('articles'));
    }
}