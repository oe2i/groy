<?php //*** DecimalX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xero\Number;

use Groy\Xero\Number\NumberX;

class DecimalX
{
	// • === number »
	public static function number($number, $separator = '.')
	{
		return NumberX::decimal($number, 'number', $separator);
	}



	// • === length »
	public static function length($number, $separator = '.')
	{
		return NumberX::decimal($number, 'length', $separator);
	}



	// • === format »
	public static function format($amount, $decimal = 2, $pad = false)
	{
		$count = self::length($amount);
		if ($count > $decimal) {
			return NumberX::round($amount, $decimal);
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