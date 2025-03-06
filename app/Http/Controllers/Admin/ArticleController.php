<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        $query = Article::with(['user', 'comments', 'tags']);

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Sort
        switch ($request->sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'most_viewed':
                $query->orderByDesc('views');
                break;
            default:
                $query->latest();
                break;
        }

        $articles = $query->paginate(10);

        return view('admin.articles', compact('articles'));
    }

    /**
     * Delete the specified article.
     */
    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return redirect()->route('admin.articles')
                ->with('success', 'Artikel berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.articles')
                ->with('error', 'Gagal menghapus artikel.');
        }
    }
} 