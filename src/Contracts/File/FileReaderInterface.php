<?php

namespace Enimiste\LaravelWebApp\Core\Contracts\File;


use Enimiste\LaravelWebApp\Core\Exception\BusinessException;

interface FileReaderInterface
{

    /**
     * @param string $filePath absolute path
     *
     * @return string
     *
     * @throws BusinessException
     */
    function getContents($filePath);
}