<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MembershipController extends Controller
{
    public function index()
    {
        $requests = MembershipRequest::with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.memberships.index', compact('requests'));
    }

    public function approve(MembershipRequest $membership)
    {
        try {
            $membership->update([
                'status' => 'approved',
                'approved_at' => now()
            ]);

            $membership->user->update([
                'membership' => $membership->type,
                'membership_expires_at' => now()->addMonth()
            ]);

            Log::info('Membership request approved', [
                'membership_id' => $membership->id,
                'user_id' => $membership->user_id,
                'type' => $membership->type
            ]);

            return back()->with('success', 'Permintaan keanggotaan berhasil disetujui');
        } catch (\Exception $e) {
            Log::error('Error approving membership request', [
                'membership_id' => $membership->id,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Gagal menyetujui permintaan keanggotaan');
        }
    }

    public function reject(MembershipRequest $membership)
    {
        try {
            $membership->update([
                'status' => 'rejected',
                'rejected_at' => now()
            ]);

            Log::info('Membership request rejected', [
                'membership_id' => $membership->id,
                'user_id' => $membership->user_id
            ]);

            return back()->with('success', 'Permintaan keanggotaan berhasil ditolak');
        } catch (\Exception $e) {
            Log::error('Error rejecting membership request', [
                'membership_id' => $membership->id,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Gagal menolak permintaan keanggotaan');
        }
    }
} 