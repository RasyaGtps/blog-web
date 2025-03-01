<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        try {
            return view('membership.index');
        } catch (\Exception $e) {
            \Log::error('Error in MembershipController@index: ' . $e->getMessage());
            return redirect()->route('stories.index')->with('error', 'Membership page is currently unavailable.');
        }
    }
} 