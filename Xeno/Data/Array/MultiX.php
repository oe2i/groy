<?php //*** MultiX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\Array;

use Groy\Xeno\Data\ArrayX;

class MultiX
{
	// • === is »
	public static function is($array)
	{
		if (ArrayX::has($array)) {
			foreach ($array as $item) {
				if (is_array($item)) {
					return true;
				}
			}
		}
		return false;
	}



	// • === one → is multi-dimensional with one record »
	public static function one($array)
	{
		return is_array($array) && count($array) === 1 && is_array(reset($array));
	}



	// • === keyNumeric → ... »
	public static function keyNumeric($array)
	{
		if (self::is($array) && KeyX::numeric($array)) {
			return true;
		}
		return false;
	}
} //> end of class ~ MultiX