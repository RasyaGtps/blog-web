<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->email_verified) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Email belum terverifikasi.'], 403);
            }
            
            return redirect()->route('verify.otp.show')
                ->with('error', 'Anda harus memverifikasi email terlebih dahulu.');
        }

        return $next($request);
    }
} 