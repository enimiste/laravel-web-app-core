<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 15:49
 */

namespace Enimiste\LaravelWebApp\Core\Support;


use Illuminate\Support\Collection;

class Str
{

    /**
     * Replace the $string with an empty one on the $from string
     *
     * @param string|array $string
     * @param string $from
     *
     * @return mixed
     */
    public static function remove($string, $from)
    {
        $replace = '';
        if (!is_array($string)) {
            $string = [$string];
            $replace = array_fill(0, count($string), '');
        }

        return str_replace($string, $replace, $from);

    }

    /**
     * Count the number of occurences of $needle in the $haystack string
     *
     * @param string $haystack
     * @param string $needle
     *
     * @return int
     */
    public static function coutOccurences($haystack, $needle)
    {
        return substr_count($haystack, $needle);
    }

    /**
     * @param int $from
     * @param int $to inclusive
     *
     * @return Collection
     */
    public static function range($from, $to)
    {
        return (new Collection(range($from, $to)))->map(function ($item) {
            return (string)$item;
        });
    }

    /**
     * @param array $rm
     * @param string $str
     *
     * @return string
     */
    public static function removeExcept(array $rm, $str)
    {
        if (is_null($str) || !is_string($str) || empty($str)) {
            return $str;
        }

        if (empty($rm)) {
            return $str;
        }


        return (new Collection(str_split($str)))->filter(function ($c) use ($rm) {
            return in_array($c, $rm);
        })->reduce(function ($acc, $c) {
            return $acc . $c;
        });
    }
}