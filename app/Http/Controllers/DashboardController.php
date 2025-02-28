<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the dashboard with user's articles.
     */
    public function index()
    {
        $articles = Article::with(['user', 'comments'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('articles'));
    }
}