<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRolesMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (($role === 'admin' && $user->isAdmin()) || 
                ($role === 'dosen' && $user->isDosen()) || 
                ($role === 'user' && $user->isUser())) {
                return $next($request);
            }
        }
        return redirect('/')->with('error', 'Unauthorized access');
    }
}
