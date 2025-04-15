<?php //*** StripX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;

class StripX
{
	// • === all → remove all occurrence from string »
	public static function all($string, $needle, $case = false)
	{
		return SwapX::all($string, $needle, '', $case);
	}



	// • === first → remove first occurrence from string »
	public static function first($string, $needle, $case = false)
	{
		return SwapX::first($string, $needle, '', $case);
	}



	// • === last → remove last occurrence from string »
	public static function last($string, $needle, $case = false)
	{
		return SwapX::last($string, $needle, '', $case);
	}



	// • === nth → remove nth character from string »
	public static function nth($string, $nth, $number = null)
	{
		$length = strlen($string);
		$nth = (int) $nth;
		$number = isset($number) ? (int) $number : 1;

		if (!StringX::has($string) || $nth <= 0 || $nth > $length || $number <= 0) {
			return $string;
		}

		if ($nth + $number - 1 > $length) {
			$number = $length - $nth + 1;
		}

		return substr($string, 0, $nth - 1) . substr($string, $nth - 1 + $number);
	}
} //> end of class ~ StripX