<?php

namespace Enimiste\LaravelWebApp\Core\Http;


use Carbon\Carbon;
use Enimiste\LaravelWebApp\Core\Assertion\AssertThat;
use Enimiste\LaravelWebApp\Core\Exception\BusinessException;
use Illuminate\Foundation\Http\FormRequest;
use InvalidArgumentException;

class WebSupport
{

    /**
     * @param FormRequest $request
     * @param $name
     * @param null $default
     * @return static
     */
    public static function fromInputDate(FormRequest $request, $name, $default = null)
    {
        if (!$request->has($name)) return $default;
        $value = $request->input($name);
        AssertThat::string($value, sprintf('Input %s date should be a formatted date string', $name));
        try {
            return Carbon::createFromFormat('d-m-Y', $value);
        } catch (InvalidArgumentException $e) {
            throw BusinessException::from($e);
        }
    }

    /**
     * @param FormRequest $request
     * @param string $name
     * @param bool $default
     * @return bool
     */
    public static function fromInputBoolean(FormRequest $request, $name, $default = false)
    {
        if (!$request->has($name)) return $default;
        $value = $request->input($name);
        return boolval($value);
    }

    /**
     * @param FormRequest $request
     * @param string $name
     * @param null $default
     * @return float
     */
    public static function fromInputFloat(FormRequest $request, $name, $default = null)
    {
        if (!$request->has($name)) return $default;
        $value = $request->input($name);
        AssertThat::numeric($value, sprintf('The input %s should be a numeric value', $name));
        return floatval($value);
    }
}