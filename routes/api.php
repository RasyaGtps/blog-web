<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Api\Admin\TagController as AdminTagController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// User Routes
Route::middleware('auth:sanctum')->group(function () {
    // Profile & User
    Route::get('/me', [UserController::class, 'me']);
    Route::patch('/profile', [UserController::class, 'updateProfile']);
    Route::post('/profile/avatar', [UserController::class, 'updateAvatar']);
    
    // Following
    Route::post('/users/{username}/follow', [UserController::class, 'follow']);
    Route::delete('/users/{username}/unfollow', [UserController::class, 'unfollow']);
    Route::get('/users/{username}/followers', [UserController::class, 'followers']);
    Route::get('/users/{username}/following', [UserController::class, 'following']);
    
    // Articles
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{id}', [ArticleController::class, 'show']);
    Route::post('/articles/{article}/comments', [ArticleController::class, 'addComment']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Admin Routes
    Route::middleware('admin')->group(function () {
        // Users Management
        Route::get('/admin/users', [AdminUserController::class, 'index']);
        
        // Articles Management
        Route::get('/admin/articles', [AdminArticleController::class, 'index']);
        Route::get('/admin/articles/filter', [AdminArticleController::class, 'filter']);

        // Tags Management
        Route::get('/admin/tags', [AdminTagController::class, 'index']);
    });
});