<?php //*** StaticX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Concept\Trait;

trait StaticX
{
	// • === property »
	public static function property(string|array $prop, $key = null)
	{
		// ➝ get property
		if (is_string($prop) && isset(self::${$prop})) {
			if (!empty($key)) {

				if (is_object(self::${$prop}) && isset(self::${$prop}->$key)) {
					return self::${$prop}->$key;
				}

				if (is_array(self::${$prop}) && isset(self::${$prop}[$key])) {
					return self::${$prop}[$key];
				}

				return false;
			}

			return self::${$prop};
		}


		// ➝ set property
		if (is_array($prop)) {

			foreach ($prop as $property => $value) {
				self::${$property} = $value;
			}

			return true;
		}

		return false;
	}

} //> end of trait ~ StaticX