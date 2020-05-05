<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Closure;

class CheckTenantDomain
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

        /** @var \App\Models\Site|null $site */
        $site = Site::where('domain', $rootDomain)->first();

        $request->session()->put('site', $site);

        if ($rootDomain !== app_main_domain() && ! $site) {
            abort(404);
        }

        return $next($request);
    }
}
