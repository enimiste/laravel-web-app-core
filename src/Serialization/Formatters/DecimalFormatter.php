<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 28/12/2016
 * Time: 14:38
 */

namespace Enimiste\LaravelWebApp\Core\Serialization\Formatters;


use Enimiste\LaravelWebApp\Core\Assertion\AssertThat;
use Enimiste\LaravelWebApp\Core\Contracts\Serialization\Formatter\FormatterInterface;
use Enimiste\LaravelWebApp\Core\Exception\BusinessException;

class DecimalFormatter implements FormatterInterface
{

    /** @var  integer */
    protected $precision;

    /**
     * @param int $precision
     * @throws BusinessException
     */
    public function setPrecision($precision = 2)
    {
        AssertThat::integer($precision);
        AssertThat::greaterThanEq($precision, 0);
        $this->precision = $precision;
    }

    /**
     * Format a value to a string, int or float
     *
     * @param string|int|float $value
     * @param array $config extra config to passe to the formatter
     *
     * @return float|int|string
     */
    function format($value, array $config = [])
    {
        if (array_key_exists('precision', $config))
            $this->setPrecision($config['precision']);
        
        return number_format($value, $this->precision, '.', '');
    }
}