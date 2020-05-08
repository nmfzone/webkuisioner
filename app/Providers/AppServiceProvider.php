<?php

namespace App\Providers;

use App\Garages\Database\Builder;
use App\Garages\Database\Concerns\SerializeEmail;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use SerializeEmail;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('tenant', function () {
            return "<?php if (request()->getHttpHost() !== app_main_domain()): ?>";
        });

        Blade::directive('elsetenant', function () {
            // @see: https://youtrack.jetbrains.com/issue/WI-52830
            // this is just temporary workaround for that.
            return '<?php else: ?>';
        });

        Blade::directive('endtenant', function () {
            return '<?php endif; ?>';
        });

        View::composer(
            '*',
            \App\Http\View\Composers\SiteComposer::class
        );

        Builder::interceptor('where', 'email', function ($type, $operator, $value) {
            if (is_string($value)) {
                return static::serializeEmail($value);
            }

            return $value;
        });
    }
}
