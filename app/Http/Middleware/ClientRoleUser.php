<?php

namespace App\Http\Middleware;

use Closure;

class ClientRoleUser
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (($request->user()->role) == 'client') {
            abort('403');
        }

        return $next($request);
    }

}
