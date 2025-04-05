<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        try {
            $user = User::with(['articles', 'followers', 'following'])->findOrFail($id);
            $followersCount = $user->followers()->count();
            $followingCount = $user->following()->count();
            $articlesCount = $user->articles()->count();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'user' => $user,
                    'stats' => [
                        'followers_count' => $followersCount,
                        'following_count' => $followingCount,
                        'articles_count' => $articlesCount
                    ]
                ]
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function me(Request $request)
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

            $user = $request->user()->load(['articles', 'followers', 'following']);
            
            // Menghitung jumlah followers dan following
            $followersCount = $user->followers()->count();
            $followingCount = $user->following()->count();
            $articlesCount = $user->articles()->count();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'user' => $user,
                    'stats' => [
                        'followers_count' => $followersCount,
                        'following_count' => $followingCount,
                        'articles_count' => $articlesCount
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch user profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 