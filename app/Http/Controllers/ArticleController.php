<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display the article creation form.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article = $request->user()->articles()->create($validated);

        return redirect()->route('articles.show', $article)
            ->with('success', 'Article published successfully!');
    }

    /**
     * Display the article and increment view count.
     */
    public function show(Article $article)
    {
        // Increment view count atomically
        DB::table('articles')
            ->where('id', $article->id)
            ->increment('views');

        // Get fresh article data with comments and users
        $article->load(['comments.user', 'user']);

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the article.
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the article.
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article->update($validated);

        return redirect()->route('articles.show', $article)
            ->with('success', 'Article updated successfully!');
    }

    /**
     * Delete the article.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        
        $article->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Article deleted successfully!');
    }

    /**
     * Store article through API.
     */
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article = $request->user()->articles()->create($validated);

        return response()->json([
            'message' => 'Article created successfully',
            'article' => $article
        ], 201);
    }
}