<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 16:35
 */

namespace Enimiste\LaravelWebApp\Core\Console;


class GenerateLarouteJsFile extends BaseBusinessCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laroute:delete-and-generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete existing laroute file and generate a new one';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = public_path('js/laroute.js');
        if (file_exists($file))
            unlink($file);
        $this->call('laroute:generate');
    }
}