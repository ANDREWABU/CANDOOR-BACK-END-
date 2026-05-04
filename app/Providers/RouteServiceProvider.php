<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';
    protected $apiNamespace = 'App\\Http\\Controllers\\Api';
    protected $adviseeApiNamespace = 'App\\Http\\Controllers\\Api\\V2\\Advisee';
    protected $advisorApiNamespace = 'App\\Http\\Controllers\\Api\\V2\\Advisor';
    
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
            // Route::prefix('api/advisee')
                ->middleware('api')
                ->namespace($this->adviseeApiNamespace)
                ->group(base_path('routes/adviseeApi.php'));
            Route::prefix('api/advisor')
                ->middleware('api')
                ->namespace($this->advisorApiNamespace)
                ->group(base_path('routes/advisorApi.php'));
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->apiNamespace)
                ->group(base_path('routes/api.php'));        

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
