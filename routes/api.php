<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ProfileController;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [AuthenticatedSessionController::class, 'apiLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'apiShow']);
    Route::post('/profile', [ProfileController::class, 'apiUpdate']);
    Route::post('/profile/avatar', [ProfileController::class, 'apiUpdateAvatar']);
    
    // Following System
    Route::post('/users/{user}/follow', [ProfileController::class, 'apiFollow']);
    Route::delete('/users/{user}/unfollow', [ProfileController::class, 'apiUnfollow']);
    Route::get('/users/{user}/followers', [ProfileController::class, 'apiFollowers']);
    Route::get('/users/{user}/following', [ProfileController::class, 'apiFollowing']);
    
    Route::post('/articles', [ArticleController::class, 'apiStore']);
});

Route::get('/stories', [StoryController::class, 'apiIndex']);
