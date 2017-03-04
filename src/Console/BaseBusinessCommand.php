<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 15:54
 */

namespace Enimiste\LaravelWebApp\Core\Console;


use Illuminate\Console\Command;

class BaseBusinessCommand extends Command
{

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }
}