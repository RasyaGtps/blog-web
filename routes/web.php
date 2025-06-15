<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\UserController as MainUserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\MembershipController as AdminMembershipController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\Auth\OtpVerificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/about', [FooterController::class, 'about'])->name('about');
Route::get('/privacy', [FooterController::class, 'privacy'])->name('privacy');
Route::get('/terms', [FooterController::class, 'terms'])->name('terms');

// Public Routes
Route::get('/users/{username}/following', [MainUserController::class, 'following'])->name('user.following');
Route::get('/users/{username}/followers', [MainUserController::class, 'followers'])->name('user.followers');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/verify-otp', [OtpVerificationController::class, 'show'])->name('verify.otp.show');
    Route::post('/verify-otp', [OtpVerificationController::class, 'verify'])->name('verify.otp');
    Route::post('/resend-otp', [OtpVerificationController::class, 'resend'])->name('resend.otp');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    
    Route::post('/follow/{user}', [ProfileController::class, 'follow'])->name('user.follow');
    Route::delete('/unfollow/{user}', [ProfileController::class, 'unfollow'])->name('user.unfollow');

    Route::post('/membership/request', [MembershipController::class, 'request'])->name('membership.request');
    Route::delete('/membership/request/{membershipRequest}', [MembershipController::class, 'cancel'])->name('membership.cancel');

    // Chat Routes
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
});


Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Users Routes
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Tags Routes
    Route::get('/tags', [TagController::class, 'index'])->name('tags');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::patch('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
    
    // Articles Routes
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('/articles/{article}', [AdminArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');
    
    Route::get('/profile', [ProfileController::class, 'adminShow'])->name('profile');
    
    // Membership Routes
    Route::get('/memberships', [AdminMembershipController::class, 'index'])->name('memberships');
    Route::patch('/memberships/{membership}/approve', [AdminMembershipController::class, 'approve'])->name('memberships.approve');
    Route::delete('/memberships/{membership}/reject', [AdminMembershipController::class, 'reject'])->name('memberships.reject');
});