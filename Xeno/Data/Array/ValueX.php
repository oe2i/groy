<?php //*** ValueX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\Array;

use Groy\Xeno\Data\ArrayX;

class ValueX
{
	// • === is → is array and value in? » boolean
	public static function is($array, $value)
	{
		return (ArrayX::has($array) && in_array($value, $array));
	}




	// • === isNot → is array but $value not in? » boolean
	public static function isNot($array, $value)
	{
		return (ArrayX::has($array) && !in_array($value, $array));
	}



	// • === first »
	public static function first($array)
	{
		if (ArrayX::has($array)) {
			return reset($array);
		}
		return false;
	}



	// • === last »
	public static function last($array)
	{
		if (ArrayX::has($array)) {
			return end($array);
		}
		return false;
	}



	// • === list → array values » boolean, numerically indexed
	public static function list($array)
	{
		if (ArrayX::has($array)) {
			return array_values($array);
		}
		return false;
	}



	// • === unique → prevent duplicate »
	public static function unique($array)
	{
		return ArrayX::unique($array);
	}
} //> end of class ~ ValueX