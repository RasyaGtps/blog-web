<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpVerification;

class OtpVerificationController extends Controller
{
    public function show()
    {
        if (!auth()->user()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if (auth()->user()->email_verified) {
            return redirect()->route('dashboard')
                ->with('info', 'Email Anda sudah terverifikasi.');
        }

        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6'
        ]);

        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($user->otp_code !== $request->otp) {
            return back()->with('error', 'Kode OTP tidak valid.');
        }

        if (Carbon::parse($user->otp_expires_at)->isPast()) {
            return back()->with('error', 'Kode OTP sudah kadaluarsa.');
        }

        $user->email_verified = true;
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Email berhasil diverifikasi!');
    }

    public function resend()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($user->email_verified) {
            return redirect()->route('dashboard')
                ->with('info', 'Email Anda sudah terverifikasi.');
        }

        // Generate new OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $user->otp_code = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        // Send OTP email
        Mail::to($user->email)->send(new OtpVerification($otp));

        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }
} 