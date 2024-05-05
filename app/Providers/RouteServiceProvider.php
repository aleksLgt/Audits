<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
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
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->routes(function () {
            $this->getRouteParameters()->each(function ($params) {
                $this->mapRoutes($params);
            });
        });
    }

    private function mapRoutes($params)
    {
        collect(File::files(base_path('routes/'.$params['dir'])))->each(function ($file) use ($params) {
            Route::prefix($params['prefix'])
                ->name($params['name'])
                ->middleware($params['middleware'])
                ->namespace($this->namespace)
                ->group($file);
        });
    }

    private function getRouteParameters(): Collection
    {
        return collect([
            'audits'        =>  ['dir' => 'audits', 'prefix' => 'audits', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'audit-blocks'  =>  ['dir' => 'audit-blocks', 'prefix' => 'audit-blocks', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'divisions'     =>  ['dir' => 'divisions', 'prefix' => 'divisions', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'auth'          =>  ['dir' => 'auth', 'prefix' => 'auth', 'name' => '', 'middleware' => 'api'],
            'roles'         =>  ['dir' => 'roles', 'prefix' => 'roles', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
            'users'         =>  ['dir' => 'users', 'prefix' => 'users', 'name' => '', 'middleware' => ['auth', 'api', 'role']],
        ]);
    }
}
