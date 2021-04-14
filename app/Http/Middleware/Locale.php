<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    public function handle($request, Closure $next)
    {
        if (\Session::has('language')) {
            app()->setLocale(\Session::get('language'));
        }

        return $next($request);
    }
}
