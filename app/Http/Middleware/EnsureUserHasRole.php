<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            return $next($request);
        }

        if ($request->user()->role_id === null) {
            abort(403, 'Your account has no role assigned. Contact an administrator.');
        }

        return $next($request);
    }
}
