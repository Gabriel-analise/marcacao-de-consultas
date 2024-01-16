<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RedirectIfAuthenticated
 * @package App\Http\Middleware
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$guards
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        /**
         * Set the default guard if no guards are provided.
         */
        $guards = empty($guards) ? [null] : $guards;

        /**
         * Check if the user is authenticated for each guard.
         * If authenticated, redirect to the home page.
         */
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        /**
         * Continue with the next middleware in the pipeline.
         */
        return $next($request);
    }
}
