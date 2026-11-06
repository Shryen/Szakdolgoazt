<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Ha nem tanár zárjon ki
        if (! auth()->check() || ! in_array(auth()->user()->role->value, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
