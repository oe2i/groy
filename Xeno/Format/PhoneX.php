<?php //*** PhoneX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Format;

use Groy\Xeno\Data\String\SwapX;
use Groy\Xeno\Data\String\StripX;
use Groy\Xeno\Data\String\BeginX;

class PhoneX
{
	// • === is »
	public static function is($number, $country){
		// TODO: implement code
	}




	// • === ngn »
	public static function ngn($number, $format = 'foreign')
	{
		if ($format === 'foreign') {
			$number = SwapX::beginIf($number, '0', '234');
			$number = BeginX::ifNot($number, '234');
		}

		if ($format === 'local') {
			$number = SwapX::beginIf($number, '234', '0');
			$number = BeginX::ifNot($number, '0');
		}

		return $number;
	}




	// • === format »
	public static function format($number, $country = 'ngn', $format = 'foreign')
	{
		$number = StripX::beginIf($number, '+');
		$country = strtolower($country);

		if (method_exists(self::class, $country)) {
			$number = self::$country($number, $format);
		}

		return $number;
	}

} //> end of class ~ PhoneX