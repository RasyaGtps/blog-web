<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\MembershipController as AdminMembershipController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');
    
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/follow/{user}', [ProfileController::class, 'follow'])->name('user.follow');
    Route::delete('/unfollow/{user}', [ProfileController::class, 'unfollow'])->name('user.unfollow');
    Route::get('/users/{user}/followers', [ProfileController::class, 'followers'])->name('user.followers');
    Route::get('/users/{user}/following', [ProfileController::class, 'following'])->name('user.following');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('/membership/request', [MembershipController::class, 'request'])->name('membership.request');
    Route::delete('/membership/request/{membershipRequest}', [MembershipController::class, 'cancel'])->name('membership.cancel');
});

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles');
    Route::delete('/articles/{article}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');
    Route::get('/profile', [ProfileController::class, 'adminShow'])->name('profile');
    
    // Membership Routes
    Route::get('/memberships', [AdminMembershipController::class, 'index'])->name('memberships');
    Route::patch('/memberships/{membership}/approve', [AdminMembershipController::class, 'approve'])->name('memberships.approve');
    Route::delete('/memberships/{membership}/reject', [AdminMembershipController::class, 'reject'])->name('memberships.reject');
});