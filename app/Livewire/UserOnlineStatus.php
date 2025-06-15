<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserOnlineStatus extends Component
{
    public $user;
    public $isOnline;
    public $lastSeen;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->isOnline = $user->online_status === true || $user->online_status === 1;
        $this->lastSeen = $user->last_seen;
    }

    public function updateStatus()
    {
        $cachedUser = cache()->remember('user_status_' . $this->user->id, 2, function() {
            return User::select(['online_status', 'last_seen'])->find($this->user->id);
        });
        
        $this->isOnline = $cachedUser->online_status === true || $cachedUser->online_status === 1;
        $this->lastSeen = $cachedUser->last_seen;
    }

    public function getListeners()
    {
        return [
            "echo:presence-online.{$this->user->id},UserOffline" => 'markAsOffline',
            "echo:presence-online.{$this->user->id},UserOnline" => 'markAsOnline',
        ];
    }

    public function markAsOffline()
    {
        $this->isOnline = false;
        $this->lastSeen = now();
    }

    public function markAsOnline()
    {
        $this->isOnline = true;
    }

    public function render()
    {
        return view('livewire.user-online-status');
    }
} 