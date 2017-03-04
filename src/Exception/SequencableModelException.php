<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 12:56
 */

namespace Enimiste\LaravelWebApp\Core\Exception;


use Exception;

class SequencableModelException extends BusinessException
{
    public function __construct($message = "", $code = 0, Exception $previous = null, $errors = [])
    {
        parent::__construct($message, $code, $previous, $errors);
    }

}