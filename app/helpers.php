<?php

use App\Models\Site;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

if (! function_exists('join_paths')) {
    /**
     * Handle the path joins.
     *
     * @param  array<int, mixed>  $args
     * @return string
     *
     * @throws \Exception
     */
    function join_paths(...$args)
    {
        if (count($args) < 2) {
            throw new \Exception('join_paths() require atleast 2 arguments!');
        }

        $paths = [];

        foreach ($args as $arg) {
            $paths = array_merge($paths, (array) $arg);
        }

        foreach ($paths as &$path) {
            $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
        }

        $firstPath = rtrim($paths[0], DIRECTORY_SEPARATOR);

        $paths = array_map(function ($p) {
            return trim($p, sprintf('"%s"', DIRECTORY_SEPARATOR));
        }, array_slice($paths, 1));

        $paths = array_merge([$firstPath], $paths);

        return join(DIRECTORY_SEPARATOR, $paths);
    }
}

if (! function_exists('join_url')) {
    /**
     * Handle the url joins.
     *
     * @param  array<int, mixed>  $args
     * @return string
     *
     * @throws \Exception
     */
    function join_url(...$args)
    {
        if (count($args) < 2) {
            throw new \Exception('join_url() require atleast 2 arguments!');
        }

        $paths = [];

        foreach ($args as $arg) {
            $paths = array_merge($paths, (array) $arg);
        }

        $paths = array_map(function ($p) {
            return trim($p, sprintf('"%s"', '/'));
        }, $paths);

        return join('/', $paths);
    }
}

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

if (! function_exists('create_dir')) {
    /**
     * Create the directory if not exists yet.
     *
     * @param  string  $path
     * @param  int  $permission
     * @return string
     */
    function create_dir($path, $permission = 0775)
    {
        if (! File::exists($path)) {
            File::makeDirectory($path, $permission, true, true);
        }

        return $path;
    }
}

if (! function_exists('tmp_path')) {
    /**
     * Get the temporary path used by system.
     *
     * @param  string  $path
     * @return string
     *
     * @throws \Exception
     */
    function tmp_path($path = '')
    {
        return join_paths(sys_get_temp_dir(), $path);
    }
}
