<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public Routes
Route::get('/users/{id}', [UserController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    // User Routes
    Route::get('/me', [UserController::class, 'me']);
    
    // Stories Route
    Route::get('/stories', [StoryController::class, 'index']);

    // Profile Routes
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
    
    // Following System
    Route::post('/users/{user}/follow', [ProfileController::class, 'follow']);
    Route::delete('/users/{user}/unfollow', [ProfileController::class, 'unfollow']);
    Route::get('/users/{user}/followers', [ProfileController::class, 'followers']);
    Route::get('/users/{user}/following', [ProfileController::class, 'following']);
    
    // Article Routes
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/articles/{article}', [ArticleController::class, 'update']);
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy']);

    // Comment Routes
    Route::post('/articles/{article}/comments', [CommentController::class, 'store']);

    // Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']); 
});