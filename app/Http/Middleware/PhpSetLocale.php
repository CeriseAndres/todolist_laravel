<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class PhpSetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        setlocale(LC_ALL, env('APP_PHP_LOCALE'));
        Carbon::setLocale(env('APP_LOCALE'));
        
        return $next($request);
    }
}