<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show(User $user)
    {
        // Prevent user from chatting with themselves
        if ($user->id === auth()->id()) {
            return redirect()->back();
        }

        return view('chat.show', [
            'user' => $user
        ]);
    }
} 