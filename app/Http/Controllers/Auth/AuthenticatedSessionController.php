<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use App\Mail\OtpVerification;

class AuthenticatedSessionController extends Controller
{
    /**
     * The path to redirect to after login.
     */
    private const HOME = '/dashboard';

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if (!$user->email_verified) {
            // Generate new OTP if not exists or expired
            if (!$user->otp_code || now()->isAfter($user->otp_expires_at)) {
                $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $user->update([
                    'otp_code' => $otp,
                    'otp_expires_at' => now()->addMinutes(5)
                ]);
                Mail::to($user->email)->send(new OtpVerification($otp));
            }
            return redirect()->route('verify.otp.show')
                ->with('warning', 'Silakan verifikasi email Anda terlebih dahulu.');
        }

        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        if ($user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'online_status' => 0,
                    'last_seen' => now()
                ]);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
