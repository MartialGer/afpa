<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleMiddleware
{
    public function handle($request, Closure $next)
{
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role_id == 1) {
            return $next($request);
        }
    }

    return redirect('/');
}
}