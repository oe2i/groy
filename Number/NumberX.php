<?php //*** NumberX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Number;

class NumberX
{
	// • === even » is even?
	public static function even($number)
	{
		return ($number % 2 == 0);
	}



	// • === odd » is odd?
	public static function odd($number)
	{
		return (!self::even($number));
	}



	// • === format → ... »
	public static function format($number, $decimal = 0, $separator = ',', $pointer = '.')
	{
		return number_format($number, $decimal, $pointer, $separator);
	}
} //> end of class ~ NumberX