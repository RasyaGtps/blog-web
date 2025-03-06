<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            // Cek jika request tidak memiliki header Accept: application/json
            if (!$request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid request. API requires Accept: application/json header'
                ], 406);
            }

            // Cek jika user tidak terautentikasi
            if (!$request->user()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthenticated. Please login first'
                ], 401);
            }

            $query = Article::query();

            // Search filter
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            }

            // Type filter (free/premium)
            if ($request->filled('type')) {
                $query->where('type', $request->type);
            }

            // Add relationships
            $query->with(['user', 'comments']);

            // Sort options
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

            // Get paginated results
            $stories = $query->paginate(10);

            // Append query parameters to pagination links
            if ($request->hasAny(['search', 'type', 'sort'])) {
                $stories->appends($request->only(['search', 'type', 'sort']));
            }

            return response()->json([
                'status' => 'success',
                'data' => $stories
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch stories',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 