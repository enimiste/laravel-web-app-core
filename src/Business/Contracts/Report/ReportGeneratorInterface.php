<?php

namespace Enimiste\LaravelWebApp\Core\Business\Contracts\Report;


interface ReportGeneratorInterface {

	/**
	 * @param array $data data to passe to view
	 *
	 * @return string path to the generated file
	 */
	function generate( array $data = [ ] );
}