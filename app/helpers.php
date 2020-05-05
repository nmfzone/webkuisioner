<?php

use App\Models\Site;
use Illuminate\Support\Str;

if (! function_exists('tenant_route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param  array|string  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     * @return string
     */
    function tenant_route($name, $parameters = [], $absolute = true)
    {
        $parameters = array_merge([
            'account' => tenant_sub_domain_prefix(),
        ], $parameters);

        return app('url')->route($name, $parameters, $absolute);
    }
}

if (! function_exists('app_main_domain')) {
    /**
     * Get the actual app main domain.
     *
     * @return string
     */
    function app_main_domain()
    {
        $url = ! Str::startsWith(env('APP_DOMAIN'), ['https://', 'http://'])
            ? 'https://' . env('APP_DOMAIN')
            : env('APP_DOMAIN');

        return Str::lower(parse_url($url, PHP_URL_HOST));
    }
}

if (! function_exists('tenant_sub_domain_prefix')) {
    /**
     * Get the tenant sub domain prefix.
     *
     * @param  \App\Models\Site|null  $site
     * @return string
     */
    function tenant_sub_domain_prefix(Site $site = null)
    {
        $host = $site ? $site->domain : request()->getHttpHost();

        return Str::lower(str_replace('.' . app_main_domain(), '', $host));
    }
}

if (! function_exists('is_tenant')) {
    /**
     * Determine if the current request is for the tenant.
     *
     * @return bool
     */
    function is_tenant()
    {
        return request()->getHttpHost() != app_main_domain();
    }
}

if (! function_exists('is_site')) {
    /**
     * Determine if the current request is for the given Site.
     *
     * @param  \App\Models\Site  $site
     * @return bool
     */
    function is_site(Site $site)
    {
        return $site->domain == request()->getHttpHost();
    }
}

if (! function_exists('asset_url')) {
    /**
     * Generate an asset url.
     *
     * @param string $path
     * @return string
     *
     * @throws Exception
     */
    function asset_url($path)
    {
        if (env('MIX_ENABLED', app()->environment('local'))) {
            return mix($path);
        }

        return asset($path);
    }
}
