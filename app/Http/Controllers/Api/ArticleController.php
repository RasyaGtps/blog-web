<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['user:id,name,username', 'tags'])
            ->select('id', 'title', 'description', 'type', 'views', 'user_id', 'created_at')
            ->latest()
            ->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Data artikel berhasil diambil',
            'data' => [
                'total_articles' => $articles->total(),
                'current_page' => $articles->currentPage(),
                'per_page' => $articles->perPage(),
                'last_page' => $articles->lastPage(),
                'articles' => $articles->items()
            ]
        ]);
    }

    public function show($id)
    {
        $article = Article::with(['user:id,name,username', 'tags'])
            ->select('id', 'title', 'description', 'content', 'type', 'views', 'user_id', 'created_at')
            ->findOrFail($id);

        // Check if the authenticated user is the owner of the article
        if ($article->user_id !== auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => 'Anda tidak memiliki akses ke artikel ini'
            ], 403);
        }

        $article->increment('views');

        return response()->json([
            'status' => true,
            'message' => 'Detail artikel berhasil diambil',
            'data' => [
                'article' => $article
            ]
        ]);
    }

    public function addComment(Request $request, Article $article)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $comment = new Comment([
            'content' => $request->content,
            'user_id' => auth()->id()
        ]);

        $article->comments()->save($comment);

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'user' => [
                    'id' => auth()->user()->id,
                    'name' => auth()->user()->name,
                    'username' => auth()->user()->username
                ],
                'created_at' => $comment->created_at
            ]
        ], 201);
    }
} 