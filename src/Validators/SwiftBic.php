<?php

namespace Enimiste\LaravelWebApp\Core\Validators;


class SwiftBic extends \IsoCodes\SwiftBic {
	/**
	 * SWIFT-BIC validator.
	 *
	 * @param string $swiftbic
	 *
	 * variant BIC Regex : /^[A-Z]{6,6}[A-Z2-9][A-NP-Z0-9]([A-Z0-9]{3,3}){0,1}?$/ based on the pain.008.001.03.xsd sepa standard
	 *
	 * @author ronan.guilloux
	 *
	 * @link   http://networking.mydesigntool.com/viewtopic.php?tid=301&id=31
	 *
	 * @return bool
	 */
	public static function validate( $swiftbic ) {
		$regexp = '/^[A-Z]{6,6}[A-Z2-9][A-NP-Z0-9]([A-Z0-9]{3,3}){0,1}?$/';

		return (boolean) preg_match( $regexp, $swiftbic );
	}

	public static function validateWithLocalCode( $swiftbic, $localCode ) {
		$regexp = '/^[A-Z]{4,4}(' . $localCode . ')[A-Z2-9][A-NP-Z0-9]([A-Z0-9]{3,3}){0,1}?$/';

		return (boolean) preg_match( $regexp, $swiftbic );
	}

}