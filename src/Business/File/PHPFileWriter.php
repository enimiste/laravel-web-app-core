<?php

namespace Enimiste\LaravelWebApp\Core\Business\File;


use Enimiste\LaravelWebApp\Core\Business\Contracts\File\FileWriterInterface;

class PHPFileWriter implements FileWriterInterface
{

    /**
     * @param string $filePath
     * @param string $content
     * @param bool $append if true the content will be appended to the existing file
     *
     * @return bool
     */
    function setContents($filePath, $content, $append = false)
    {
        if ($append) {
            return file_put_contents($filePath, $content, FILE_APPEND);
        } else {
            return file_put_contents($filePath, $content);
        }
    }
}