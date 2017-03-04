<?php

namespace Enimiste\LaravelWebApp\Core\Business\Contracts\File;


interface FileReaderInterface
{

    /**
     * @param string $filePath absolute path
     *
     * @return string
     *
     * @throws \Exception
     */
    function getContents($filePath);
}