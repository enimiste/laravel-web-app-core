<?php
namespace Enimiste\LaravelWebApp\Core\Generators;


use Enimiste\LaravelWebApp\Core\Contracts\TokenGeneratorInterface;
use Ramsey\Uuid\Uuid;

class RamseyUuidTokenGenerator implements TokenGeneratorInterface
{


    /**
     * Return the next unique token
     *
     * @return string
     */
    function nextToken(array $config = [])
    {
        if (array_key_exists('ns', $config) && array_key_exists('name', $config))
            return Uuid::uuid5($config['ns'], $config['name'])->toString();
        else
            return Uuid::uuid4()->toString();
    }
}