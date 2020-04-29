<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use App\Models\Site;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAndSyncParticipant
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
        $rootDomain = $request->getHttpHost();

        if (count(explode('.', $rootDomain)) == env('SUB_DOMAIN_LEVEL', 3)) {
            /** @var \App\Models\Site|null $site */
            $site = Site::where('domain', $rootDomain)->first();

            if (! $site) {
                abort(404);
            }

            if (Auth::check() &&
                Auth::user()->role === Role::PARTICIPANT &&
                ! $site->participants()->find(Auth::user()->id)) {
                Auth::user()->participations()->save($site);
            }
        }

        return $next($request);
    }
}
