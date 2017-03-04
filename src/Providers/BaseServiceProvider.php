<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 12:52
 */

namespace Enimiste\LaravelWebApp\Core\Providers;


use Illuminate\Support\ServiceProvider;

abstract class BaseServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    abstract public function boot();

    /**
     * Register any application services.
     *
     * @return void
     */
    abstract public function register();

    /**
     * Check if the APP_ENV of this web app is 'local'
     *
     * @return boolean
     */
    public function isLocal()
    {
        return $this->app->environment() == 'local';
    }
}