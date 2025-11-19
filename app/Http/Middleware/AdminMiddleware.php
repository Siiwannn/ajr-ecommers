<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Optional: Cek apakah user adalah admin
        // if (!auth()->user()->is_admin) {
        //     abort(403, 'Unauthorized');
        // }

        return $next($request);
    }
}
