<?php

namespace Enimiste\LaravelWebApp\Core\Business\Contracts\File;


interface FileWriterInterface
{

    /**
     * @param string $filePath absolute path
     * @param string $content
     * @param bool $append if true the content will be appended to the existing file
     *
     * @return bool
     */
    function setContents($filePath, $content, $append = false);
}