<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotStandOwner
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('standowner')->check()) {
            return redirect()->route('standowner.login');
        }

        return $next($request);
    }
}
