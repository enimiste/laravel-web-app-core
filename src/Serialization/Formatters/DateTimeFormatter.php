<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 28/12/2016
 * Time: 14:44
 */

namespace Enimiste\LaravelWebApp\Core\Serialization\Formatters;


use Enimiste\LaravelWebApp\Core\Assertion\AssertThat;
use Enimiste\LaravelWebApp\Core\Contracts\Serialization\Formatter\FormatterInterface;
use Enimiste\LaravelWebApp\Core\Exception\BusinessException;

class DateTimeFormatter implements FormatterInterface
{
    /** @var  string */
    protected $format;

    /**
     * @param string $format
     * @throws BusinessException
     */
    public function setFormat($format = 'd-m-Y H:i:s')
    {
        AssertThat::string($format);
        $this->format = $format;
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
        if (array_key_exists('format', $config))
            $this->setFormat($config['format']);
        
        return $value instanceof \DateTime ? $value->format($this->format) : '';
    }
}