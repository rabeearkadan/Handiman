<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->cmsWebRoutes();
        $this->funWebRoutes();
        $this->authWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    // for general website ( aboutus , contact us , homepage .....)
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }
    // for employee access
    protected function funWebRoutes()
    {
        Route::middleware(['web','auth','employee','verified'])
            ->prefix('employee')
            ->namespace($this->namespace.'\FRONT\Employee')
            ->group(base_path('routes/employee.php'));
    }
    // for user access
    protected function authWebRoutes()
    {
        Route::middleware(['web','auth','client','verified'])
            ->prefix('client')
            ->namespace($this->namespace.'\FRONT\Client')
            ->group(base_path('routes/client.php'));
    }
    // for admin access
    protected function cmsWebRoutes()
    {
        Route::middleware(['web','auth','admin'])
            ->namespace($this->namespace.'\CMS')
            ->prefix('admin')
            ->group(base_path('routes/cms.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace.'\API')
             ->group(base_path('routes/api.php'));
    }
}
