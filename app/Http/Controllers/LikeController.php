<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Article $article)
    {
        $article->like(auth()->user());

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Article liked successfully',
                'likes_count' => $article->likes()->count()
            ]);
        }

        return back()->with('success', 'Article liked successfully!');
    }

    public function unlike(Article $article)
    {
        $article->unlike(auth()->user());

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Article unliked successfully',
                'likes_count' => $article->likes()->count()
            ]);
        }

        return back()->with('success', 'Article unliked successfully!');
    }
} 