<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('articles.create', compact('tags'));
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'tags' => 'required|array|min:1|max:5',
            'tags.*' => 'exists:tags,id',
            'type' => auth()->user()->role === 'verified' ? 'required|in:free,premium' : 'sometimes'
        ]);

        $article = auth()->user()->articles()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'type' => $validated['type'] ?? 'free'
        ]);

        if (isset($validated['tags'])) {
            $article->tags()->attach($validated['tags']);
        }

        return redirect()->route('articles.show', $article)
            ->with('success', 'Article published successfully!');
    }

    /**
     * Display the article and increment view count.
     */
    public function show(Article $article)
    {
        if (auth()->check()) {
            $sessionKey = 'article_' . $article->id . '_last_view';
            $lastView = session()->get($sessionKey);
            $now = now();

            // Cek apakah sudah lebih dari 1 jam sejak view terakhir atau belum pernah dilihat
            if (!$lastView || $now->diffInHours($lastView) >= 1) {
                $article->increment('views');
                session()->put($sessionKey, $now);
            }
        }

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the article.
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        $tags = Tag::orderBy('name')->get();
        return view('articles.edit', compact('article', 'tags'));
    }

    /**
     * Update the article.
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'tags' => 'required|array|min:1|max:5',
            'tags.*' => 'exists:tags,id',
            'type' => auth()->user()->role === 'verified' ? 'required|in:free,premium' : 'sometimes'
        ]);

        $article->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'type' => $validated['type'] ?? 'free'
        ]);

        if (isset($validated['tags'])) {
            $article->tags()->sync($validated['tags']);
        }

        return redirect()->route('dashboard')
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

}