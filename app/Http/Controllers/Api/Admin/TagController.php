<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('articles')
            ->orderBy('name')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data tags berhasil diambil',
            'data' => [
                'total_tags' => $tags->count(),
                'tags' => $tags
            ]
        ]);
    }
} 