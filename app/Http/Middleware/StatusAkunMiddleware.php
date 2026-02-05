<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusAkunMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->status_akun !== 'aktif') {
            return redirect()->back()
                ->with('error', 'Maaf, akun Anda belum aktif');
        }

        return $next($request);
    }
}
