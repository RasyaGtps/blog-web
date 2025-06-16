<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        $query = Article::with(['user', 'tags', 'likes']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }

        $articles = $query->latest()->paginate(10);

        return view('admin.articles', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('admin.articles.create', compact('tags'));
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'content' => ['required', 'string'],
            'tags' => ['required', 'array'],
            'tags.*' => ['exists:tags,id'],
            'type' => ['required', 'in:free,premium']
        ]);

        $article = Article::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'type' => $validated['type'],
            'user_id' => auth()->id(),
            'views' => 0
        ]);

        if (isset($validated['tags'])) {
            $article->tags()->attach($validated['tags']);
        }

        return redirect()->route('admin.articles')
            ->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        $tags = Tag::all();
        $selectedTags = $article->tags->pluck('id')->toArray();
        
        return view('admin.articles.edit', compact('article', 'tags', 'selectedTags'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'content' => ['required', 'string'],
            'cover_image' => ['nullable', 'url'],
            'tags' => ['required', 'array'],
            'tags.*' => ['exists:tags,id'],
            'type' => ['required', 'in:free,premium']
        ]);

        $article->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'cover_image' => $request->cover_image,
            'type' => $request->type
        ]);

        $article->tags()->sync($request->tags);

        return redirect()->route('admin.articles')
            ->with('success', 'Article updated successfully.');
    }

    /**
     * Delete the specified article.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles')
            ->with('success', 'Article deleted successfully.');
    }
} 