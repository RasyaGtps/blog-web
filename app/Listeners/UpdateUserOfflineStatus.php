<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;

class UpdateUserOfflineStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        if ($event->user) {
            DB::table('users')
                ->where('id', $event->user->id)
                ->update([
                    'online_status' => 0,
                    'last_seen' => now()
                ]);
        }
    }
} 