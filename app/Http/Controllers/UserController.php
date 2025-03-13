<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function followers($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $followers = $user->followers()->with(['articles', 'followers'])->paginate(20);
        
        return view('profile.followers', compact('user', 'followers'));
    }

    public function following($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $following = $user->following()->with(['articles', 'followers'])->paginate(20);
        
        return view('profile.following', compact('user', 'following'));
    }
} 