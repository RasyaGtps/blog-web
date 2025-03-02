<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        $articles = Article::with(['user', 'comments'])
            ->latest()
            ->paginate(12);

        $tags = Tag::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->limit(10)
            ->get();

        return view('stories.index', compact('articles', 'tags'));
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