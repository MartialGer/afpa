<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roleIds)
    {
        if (Auth::check()) {
            $user = Auth::user();
    
            if (in_array($user->role_id, $roleIds)) {
                return $next($request);
            }
        }
    
        return redirect('/');
    }
}
