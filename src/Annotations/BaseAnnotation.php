<?php

namespace Enimiste\LaravelWebApp\Core\Annotations;

/**
 * Class BaseAnnotation
 * @package Org\Asso\Annotations
 */
abstract class BaseAnnotation {

	/**
	 * ApiDoc constructor.
	 *
	 * @param array $config
	 */
	public function __construct( array $config ) {
		foreach ( $config as $key => $conf ) {
			if ( property_exists( $this, $key ) ) {
				$this->$key = $config;
			}
		}
	}
}