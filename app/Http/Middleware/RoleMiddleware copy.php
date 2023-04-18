<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        dd($roles);
       
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $user = User::find($userId);
                   
            foreach ($roles as $role) {
                
                if ($user->hasRole($role)) {
                    return $next($request);
                }
            }
        }

        return redirect('/');
    }
}