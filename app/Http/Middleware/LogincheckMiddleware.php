<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class LoginCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Cache::has('user')){
            $user = Cache::pull('user');
            if(!empty($user)) {
                $expiresAt = Carbon::now()->addMinutes(10);
                Cache::put('user', $user, $expiresAt);
                return $next($request);
            }
        }

        return redirect('/login');
    }
}
