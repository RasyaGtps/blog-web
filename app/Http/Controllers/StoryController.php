<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $articles = Article::with(['user', 'comments'])
            ->latest()
            ->paginate(12);

        return view('stories.index', compact('articles'));
    }

    public function apiIndex()
    {
        $articles = Article::with(['user', 'comments'])
            ->latest()
            ->paginate(12);

        return response()->json([
            'articles' => $articles,
            'pagination' => [
                'total' => $articles->total(),
                'per_page' => $articles->perPage(),
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage()
            ]
        ]);
    }
} 