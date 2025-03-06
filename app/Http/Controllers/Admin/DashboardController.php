<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Users
        $totalUsers = User::count();
        $newUsersToday = User::whereDate('created_at', Carbon::today())->count();

        // Total Articles
        $totalArticles = Article::count();
        $newArticlesToday = Article::whereDate('created_at', Carbon::today())->count();

        // User Roles Statistics
        $userRoles = User::select('role', DB::raw('count(*) as count'))
                        ->groupBy('role')
                        ->get();

        // Membership Statistics
        $memberships = User::select('membership', DB::raw('count(*) as count'))
                          ->groupBy('membership')
                          ->get();

        // Latest Users
        $latestUsers = User::latest()
                          ->take(5)
                          ->get();

        // Latest Articles
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
} 