<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $redir = route('artist.index');
        switch ($guard) {
            case "admin":
                $redir = route('admin::index');
                break;
            default:
                $redir = route('artist.index');
                break;
        }

        if (Auth::guard($guard)->check()) {
            return redirect($redir);
        }

        return $next($request);
    }
}
