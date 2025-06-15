<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['user', 'comments', 'tags']);

        // Filter by followed authors
        if ($request->has('filter') && $request->filter === 'following' && auth()->check()) {
            $followedUsers = auth()->user()->following()->pluck('users.id');
            $query->whereIn('user_id', $followedUsers);
        }
        // Filter by tag if provided
        elseif ($request->has('tag')) {
            $tagName = $request->tag;
            $query->whereHas('tags', function($q) use ($tagName) {
                $q->where('name', $tagName);
            });
        }

        $articles = $query->latest()->paginate(12);

        $tags = Tag::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->limit(10)
            ->get();

        $randomArticles = Article::with('user')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('stories.index', compact('articles', 'tags', 'randomArticles'));
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