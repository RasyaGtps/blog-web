<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $featuredArticles = Article::with(['user'])
            ->orderBy('views', 'desc')
            ->take(3)
            ->get();
        $tags = Tag::all();
        return view('welcome', compact('featuredArticles', 'tags'));
    }
}