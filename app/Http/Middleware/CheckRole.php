<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        // if (!$user || !$user->hasRole($role)) {
        //     return redirect()->route('home')->with('error', 'Unauthorized access');
        // }

        return $next($request);
    }
}
