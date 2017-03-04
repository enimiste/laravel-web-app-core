<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 12:52
 */

namespace Enimiste\LaravelWebApp\Core\Providers;


use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Enimiste\LaravelWebApp\Core\Business\Contracts\File\FileReaderInterface;
use Enimiste\LaravelWebApp\Core\Business\Contracts\File\FileWriterInterface;
use Enimiste\LaravelWebApp\Core\Business\File\PHPFileReader;
use Enimiste\LaravelWebApp\Core\Business\File\PHPFileWriter;
use Enimiste\LaravelWebApp\Core\Exception\ContainerException;

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
         * For dev environment only
         */
        if ($this->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->bind(FileReaderInterface::class, PHPFileReader::class);
        $this->app->bind(FileWriterInterface::class, PHPFileWriter::class);
    }
}