<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 12:38
 */

namespace Enimiste\LaravelWebApp\Core\Exception;


use Exception;
use Illuminate\Contracts\Support\Jsonable;

class BusinessException extends \RuntimeException
{
    /** @var  array */
    protected $errors;

    public function __construct($message = "", $code = 0, Exception $previous = null, $errors = [])
    {
        parent::__construct($message, $code, $previous);

        $this->errors = collect($errors)->map(function ($e) {
            if (!is_string($e)) {
                if ($e instanceof Jsonable) return $e->toJson();
                else return json_encode($e);
            } else return $e;
        })->toArray();
        array_unshift($this->errors, $message);
    }

    /**
     * @param Exception $ex
     *
     * @return BusinessException
     */
    public static function from(Exception $ex)
    {
        return new self($ex->getMessage(), $ex->getCode(), $ex);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }


}