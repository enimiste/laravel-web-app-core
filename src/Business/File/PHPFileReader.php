<?php

namespace Enimiste\LaravelWebApp\Core\Business\File;


use Enimiste\LaravelWebApp\Core\Business\Contracts\File\FileReaderInterface;

class PHPFileReader implements FileReaderInterface {

	/**
	 * @param string $filePath
	 *
	 * @return string
	 *
	 * @throws \Exception
	 */
	function getContents( $filePath ) {
		return file_get_contents( $filePath );
	}
}