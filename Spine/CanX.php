<?php //*** CanX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Spine;

class CanX
{
	// • === iterate » boolean
	public static function iterate(&$var)
	{
		return is_iterable($var);
	}



	// • === string » boolean
	public static function string(&$var)
	{
		if (!blank($var)) {

			// ~ is scalar [string, integer, float, or boolean]
			if (is_scalar($var)) {
				return true;
			}

			// ~ is an object that implements __toString
			if (is_object($var) && method_exists($var, '__toString')) {
				return true;
			}
		}

		return false;
	}
} //> end of class ~ CanX