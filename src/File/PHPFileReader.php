<?php

namespace Enimiste\LaravelWebApp\Core\File;


use Enimiste\LaravelWebApp\Core\Contracts\File\FileReaderInterface;
use Enimiste\LaravelWebApp\Core\Exception\BusinessException;

class PHPFileReader implements FileReaderInterface {

	/**
	 * @param string $filePath
	 *
	 * @return string
	 *
	 * @throws BusinessException
	 */
	function getContents( $filePath ) {
		return file_get_contents( $filePath );
	}
}