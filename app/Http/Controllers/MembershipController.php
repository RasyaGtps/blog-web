<?php

namespace App\Http\Controllers;

use App\Models\MembershipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function index()
    {
        Log::info('Accessing membership index page');
        
        $latestRequest = null;
        if (Auth::check()) {
            Log::info('User is authenticated, fetching latest request');
            $latestRequest = Auth::user()->membershipRequests()->latest()->first();
        } else {
            Log::info('User is not authenticated');
        }

        Log::info('Rendering membership.index view');
        return view('membership.index', compact('latestRequest'));
    }

    public function request(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to request membership.');
        }

        try {
            $request->validate([
                'type' => 'required|in:basic,premium'
            ]);

            $existingRequest = Auth::user()->membershipRequests()
                ->where('status', 'pending')
                ->first();

            if ($existingRequest) {
                return back()->with('error', 'You already have a pending membership request.');
            }

            $membershipRequest = Auth::user()->membershipRequests()->create([
                'type' => $request->type,
                'status' => 'pending'
            ]);

            return back()->with('success', 'Your membership request has been submitted successfully.');
        } catch (\Exception $e) {
            Log::error('Error in MembershipController@request: ' . $e->getMessage());
            return back()->with('error', 'Failed to submit membership request. Please try again.');
        }
    }

    public function cancel(MembershipRequest $membershipRequest)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to cancel membership request.');
        }

        try {
            if ($membershipRequest->user_id !== Auth::id()) {
                return back()->with('error', 'Unauthorized action.');
            }

            if ($membershipRequest->status !== 'pending') {
                return back()->with('error', 'Only pending requests can be cancelled.');
            }

            $membershipRequest->delete();

            return back()->with('success', 'Membership request cancelled successfully.');
        } catch (\Exception $e) {
            Log::error('Error in MembershipController@cancel: ' . $e->getMessage());
            return back()->with('error', 'Failed to cancel membership request.');
        }
    }
} 