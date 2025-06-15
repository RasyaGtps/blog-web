<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a list of chat conversations
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get unique users that the current user has chatted with
        $chatUsers = User::whereIn('id', function($query) use ($user) {
            $query->select('from_user_id')
                  ->from('messages')
                  ->where('to_user_id', $user->id)
                  ->union(
                      Message::select('to_user_id')
                            ->where('from_user_id', $user->id)
                  );
        })->get();

        return view('chat.index', compact('chatUsers'));
    }

    /**
     * Show chat conversation with specific user
     */
    public function show(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('chat.index');
        }

        return view('chat.show', compact('user'));
    }
} 