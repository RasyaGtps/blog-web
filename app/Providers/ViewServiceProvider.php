<?php

namespace App\Providers;

use App\Models\MembershipRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share pending requests count dengan semua view yang menggunakan layout admin
        View::composer('layouts.admin', function ($view) {
            $pendingRequests = MembershipRequest::where('status', 'pending')->count();
            $view->with('pendingRequests', $pendingRequests);
        });
    }
}
