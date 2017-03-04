<?php

namespace Enimiste\LaravelWebApp\Core\Validators;

/**
 * Class Iban
 * regex : [A-Z]{2,2}[0-9]{2,2}[a-zA-Z0-9]{1,30} based on the pain.008.001.03.xsd sepa standard
 * @package Com\NextGen\Business\Common\Validators
 */
class Iban extends \IsoCodes\Iban {
	/**
	 * Iban validator.
	 *
	 * @author  petitchevalroux
	 * @licence originale http://creativecommons.org/licenses/by-sa/2.0/fr/
	 *
	 * @link    http://dev.petitchevalroux.net/php/validation-iban-php.356.html + comments & links
	 *
	 * @param string $iban
	 *
	 * @return bool
	 */
	public static function validate( $iban ) {
		$is_valid = parent::validate( $iban );

		if ( $is_valid ) {
			$regexp = '/^[A-Z]{2,2}[0-9]{2,2}[a-zA-Z0-9]{1,30}?$/';

			return (boolean) preg_match( $regexp, $iban );
		} else {
			return $is_valid;
		}
	}

}