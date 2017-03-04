<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 16:03
 */

namespace Enimiste\LaravelWebApp\Core\Generators;


use Enimiste\LaravelWebApp\Core\Contracts\TokenGeneratorInterface;

class CurrentTimeTokenBasedGenerator implements TokenGeneratorInterface
{

    /**
     * Return the next unique token
     *
     * @param array $config extra config
     * @return string
     */
    function nextToken(array $config = [])
    {
        $prefix = array_get($config, 'prefix', '');

        return $prefix . time();
    }
}