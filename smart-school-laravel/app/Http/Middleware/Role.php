<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        foreach ($roles as $role) {
            // Log::info("role looping:" . $role);
            // Check if user has the role This check will depend on how your roles are set up
            if ($user->tokenCan('role:' . $role)) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Unauthenticated.'], 401);
    }
}
