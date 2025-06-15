<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
            ->select('id', 'name', 'username', 'email', 'role', 'created_at')
            ->paginate(10);

        return response()->json($users);
    }
} 