<?php //*** DecimalX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Number;

use Groy\Xeno\Data\StringX;

class DecimalX
{
	// • === number »
	public static function number($number, $option = 'number', $separator = '.')
	{
		$decimalNumber = StringX::after($number, $separator);
		if ($option === 'number') {
			return $decimalNumber ?? false;
		}
		return !is_null($decimalNumber) ? strlen($decimalNumber) : 0;
	}




	// • === length »
	public static function length($number, $separator = '.')
	{
		return self::number($number, 'length', $separator);
	}




	// • === round »
	public static function round($number, $decimal = 2)
	{
		$number = round($number, $decimal);
		return (float) $number;
	}




	// • === format »
	public static function format($amount, $decimal = 2, $pad = false)
	{
		$count = self::length($amount);
		if ($count > $decimal) {
			return self::round($amount, $decimal);
		} elseif ($count === $decimal) {
			return $amount;
		} elseif ($count < 1) {
			return $amount . '.00';
		} elseif ($count < $decimal) {
			if ($pad) {
				$difference = ($decimal - $count);
				for ($i = 0; $i < $difference; $i++) {
					$amount .= '0';
				}
			}
		}
		return $amount;
	}
} //> end of class ~ DecimalX