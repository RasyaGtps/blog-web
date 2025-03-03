<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\MembershipController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    // Registration Routes
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Login Routes
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Following Routes
    Route::post('/follow/{user}', [ProfileController::class, 'follow'])->name('user.follow');
    Route::delete('/unfollow/{user}', [ProfileController::class, 'unfollow'])->name('user.unfollow');
    Route::get('/users/{user}/followers', [ProfileController::class, 'followers'])->name('user.followers');
    Route::get('/users/{user}/following', [ProfileController::class, 'following'])->name('user.following');

    // Auth Routes
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Article Routes
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Comment Routes
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
});

// Public Routes
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Temporary route for development - REMOVE IN PRODUCTION
// Route::get('/logout', function () {
//     Auth::logout();
//     Session::flush();
//     return redirect('/');
// });

// Remove the auth.php require since we're defining routes here
// require __DIR__.'/auth.php';

// Add this to your web routes
Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');

Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');
