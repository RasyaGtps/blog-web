<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['user:id,name,username', 'tags:id,name'])
            ->select('id', 'title', 'description', 'type', 'user_id', 'views', 'created_at')
            ->latest()
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'description' => $article->description,
                    'type' => $article->type,
                    'views' => $article->views,
                    'user' => $article->user,
                    'tags' => $article->tags,
                    'created_at' => $article->created_at
                ];
            });

        return response()->json([
            'articles' => $articles
        ]);
    }

    public function filter(Request $request)
    {
        $query = Article::with(['user:id,name,username', 'tags:id,name'])
            ->select('id', 'title', 'description', 'content', 'type', 'user_id', 'views', 'created_at');

        // Search by title or content
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by type (free/premium)
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by tag
        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Sort by
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'most_viewed':
                $query->orderBy('views', 'desc');
                break;
            case 'most_commented':
                $query->withCount('comments')->orderBy('comments_count', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $articles = $query->get()->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'description' => $article->description,
                'type' => $article->type,
                'views' => $article->views,
                'user' => $article->user,
                'tags' => $article->tags,
                'created_at' => $article->created_at
            ];
        });

        return response()->json([
            'articles' => $articles
        ]);
    }
} 