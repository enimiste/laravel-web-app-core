<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 12:52
 */

namespace Enimiste\LaravelWebApp\Core\Providers;


use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Enimiste\LaravelWebApp\Core\Contracts\File\FileReaderInterface;
use Enimiste\LaravelWebApp\Core\Contracts\File\FileWriterInterface;
use Enimiste\LaravelWebApp\Core\Contracts\Report\ReportFromHtmlGeneratorInterface;
use Enimiste\LaravelWebApp\Core\Contracts\TokenGeneratorInterface;
use Enimiste\LaravelWebApp\Core\Exception\ContainerException;
use Enimiste\LaravelWebApp\Core\File\PHPFileReader;
use Enimiste\LaravelWebApp\Core\File\PHPFileWriter;
use Enimiste\LaravelWebApp\Core\Generators\RamseyUuidTokenGenerator;
use Enimiste\LaravelWebApp\Core\Report\WkhtmltopdfReportGenerator;
use Illuminate\Contracts\Auth\Authenticatable;

class WebAppServiceProvider extends BaseServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Check if artisan.php and public/index.php files 
         * defines the "running_from_artisan" boolean binding
         * in the container
         */
        if (!$this->app->bound('running_from_artisan'))
            throw new ContainerException('You should bind "running_from_artisan" boolean into the container in the files artisan.php and public/index.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
        |--------------------------------------------------------------------------
        | For dev environment only
        |--------------------------------------------------------------------------
        |
        */
        if ($this->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        /*
        |--------------------------------------------------------------------------
        | Authentication
        |--------------------------------------------------------------------------
        |
        */
        $this->app->bind('authenticated_user_email', function () {
            $u = $this->app->make(Authenticatable::class);
            if (!is_null($u)) return $u->email;
            else {
                if ($this->app->make('running_from_artisan'))
                    return 'SYSTEM';
                else return 'NOT_AUTHENTICATED';
            }
        });
        
        /*
        |--------------------------------------------------------------------------
        | Local File I/O
        |--------------------------------------------------------------------------
        |
        */
        $this->app->bind(FileReaderInterface::class, PHPFileReader::class);
        $this->app->bind(FileWriterInterface::class, PHPFileWriter::class);

        /*
        |--------------------------------------------------------------------------
        | Id Generators
        |--------------------------------------------------------------------------
        |
        */
        $this->app->bind(TokenGeneratorInterface::class, RamseyUuidTokenGenerator::class);

        /*
        |--------------------------------------------------------------------------
        | Html to pdf report generator
        |--------------------------------------------------------------------------
        |
        */
        $this->app->bind(ReportFromHtmlGeneratorInterface::class, WkhtmltopdfReportGenerator::class);
    }
}