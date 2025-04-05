<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

#[\Livewire\Attributes\Layout('layouts.app')]
class Chat extends Component
{
    public $userId;
    public $message = '';
    public $messages = [];
    public $receiver;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->receiver = User::findOrFail($userId);
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function($query) {
            $query->where('from_user_id', auth()->id())
                  ->where('to_user_id', $this->userId);
        })->orWhere(function($query) {
            $query->where('from_user_id', $this->userId)
                  ->where('to_user_id', auth()->id());
        })
        ->with(['fromUser', 'toUser'])
        ->orderBy('created_at', 'asc')
        ->get();
    }

    public function sendMessage()
    {
        if (empty(trim($this->message))) {
            return;
        }

        $message = Message::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $this->userId,
            'message' => $this->message
        ]);

        $this->message = '';
        $this->loadMessages();

        // Broadcast event untuk real-time update
        $this->dispatch('messageReceived');
    }

    #[On('messageReceived')]
    public function handleNewMessage()
    {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat');
    }
} 