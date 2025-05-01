<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Jika role tidak ditentukan, lanjutkan saja
        if ($role === null) {
            return $next($request);
        }

        if ($role === 'admin' && !auth()->user()->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        if ($role === 'member' && !auth()->user()->isMember()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
