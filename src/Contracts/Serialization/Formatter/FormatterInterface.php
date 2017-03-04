<?php

namespace Enimiste\LaravelWebApp\Core\Contracts\Serialization\Formatter;


interface FormatterInterface
{

    /**
     * Format a value to a string, int or float
     *
     * @param string|int|float $value
     * @param array $config extra config to passe to the formatter
     *
     * @return float|int|string
     */
    function format($value, array $config = []);
}