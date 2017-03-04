<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 25/03/2016
 * Time: 22:13
 */

namespace Enimiste\LaravelWebApp\Core\Serialization\Formatters;



use Enimiste\LaravelWebApp\Core\Contracts\Serialization\Formatter\FormatterInterface;

class BooleanFormatter implements FormatterInterface {

	/**
	 * Format a value to a string, int or float
	 *
	 * @param string|int|float $value
	 * @param array $config extra config to passe to the formatter
	 *
	 * @return float|int|string
	 */
	function format($value, array $config = []) {
		if ( is_bool( $value ) ) {
			return $value ? 1 : 0;
		}

		return $value;
	}
}