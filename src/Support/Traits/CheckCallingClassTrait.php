<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 15:50
 */

namespace Enimiste\LaravelWebApp\Core\Support\Traits;


use Enimiste\LaravelWebApp\Core\Exception\CallingClassCheckException;
use Illuminate\Support\Collection;

trait CheckCallingClassTrait
{
    /**
     * AND
     *
     * @param string $interface
     * @param string $methodName to protect by this check
     *
     * @throws CallingClassCheckException
     */
    public static function checkCallingInterface($interface, $methodName)
    {
        //2 parce checkCallingInterface < (appelée par) {save ou create } < (appelée aussi par) une classe externe (0 < 1 < 2)
        $callingClass = (new Collection(debug_backtrace()))->get(2)['class'];

        $ref = new \ReflectionClass($callingClass);
        if (!is_array($interface)) {
            $interface = [$interface];
        }
        foreach ($interface as $int) {
            if (!$ref->implementsInterface($int)) {
                throw new CallingClassCheckException(sprintf('The function %s of the class %s should be called from %s implementation',
                    $methodName,
                    __CLASS__,
                    $int));
            }
        }
    }

    /**
     * OR
     *
     * @param string $class
     * @param string $methodName to protect by this check
     *
     * @throws CallingClassCheckException
     */
    public static function checkCallingClassOr($class, $methodName)
    {
        //2 parce checkCallingInterface < (appelée par) {save ou create } < (appelée aussi par) une classe externe (0 < 1 < 2)
        $callingClass = (new Collection(debug_backtrace()))->get(2)['class'];

        if (!is_array($class)) {
            $class = [$class];
        }

        if (!in_array($callingClass, $class)) {
            throw new CallingClassCheckException(sprintf('The function %s of the class %s should be called from %s classes',
                $methodName,
                __CLASS__,
                implode(',', $class)));
        }
    }
}