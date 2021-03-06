<?php
namespace Enimiste\LaravelWebApp\Core\Contracts;


interface TokenGeneratorInterface
{

    /**
     * Return the next unique token
     *
     * @param array $config extra config
     * @return string
     */
    function nextToken(array $config = []);
}