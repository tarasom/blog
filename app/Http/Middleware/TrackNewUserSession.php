<?php

namespace App\Http\Middleware;

use App\Entities\UserSession;
use Closure;
use Browser;

class TrackNewUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->runningInConsole()) {
            return $next($request);
        }

        if (false === $request->session()->exists('tracked')) {
            $this->trackNewUserSession($request);
        }

        return $next($request);
    }

    /**
     * @param $request
     */
    private function trackNewUserSession($request)
    {
        (new UserSession())
            ->setIp($request->getClientIp())
            ->setUserAgent(Browser::userAgent())
            ->setBrowserFamily(Browser::browserFamily())
            ->save();

        $request->session()->put('tracked', true);

        $request->session()->save();
    }
}
