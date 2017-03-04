<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 12:54
 */

namespace Enimiste\LaravelWebApp\Core\Assertion;


use Enimiste\LaravelWebApp\Core\Exception\BusinessException;
use Webmozart\Assert\Assert;

class AssertThat extends Assert
{
    /**
     * @param $message
     */
    protected static function reportInvalidArgument($message)
    {
        try {
            parent::reportInvalidArgument($message);
        } catch (\InvalidArgumentException $e) {
            throw  BusinessException::from($e);
        }
    }

    /**
     * @param $value
     * @param string $message
     */
    public static function false($value, $message = '')
    {
        if (false !== boolval($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to be false. Got: %s',
                static::valueToString($value)
            ));
        }
    }

    /**
     * @param $value
     * @param string $message
     */
    public static function true($value, $message = '')
    {
        if (true !== boolval($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to be true. Got: %s',
                static::valueToString($value)
            ));
        }
    }

    /**
     * @param $value
     * @param array $values
     * @param string $message
     */
    public static function in($value, array $values, $message = '')
    {
        if (!in_array($value, $values)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Expected a value to be in the array values. Got: %s',
                static::valueToString($value)
            ));
        }
    }
}