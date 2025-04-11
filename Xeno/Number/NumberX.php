<?php //*** NumberX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Number;

class NumberX
{
	// • === even » is even?
	public static function even($number)
	{
		return ($number % 2 == 0);
	}



	// • === evenBetween »
	public static function evenBetween(int $start, int $end): array
	{
		$evens = [];
		for ($i = $start; $i <= $end; $i++) {
			if ($i % 2 === 0) {
				$evens[] = $i;
			}
		}
		return $evens;
	}



	// • === odd » is odd?
	public static function odd($number)
	{
		return (!self::even($number));
	}



	// • === oddBetween »
	public static function oddBetween(int $start, int $end): array
	{
		$odds = [];
		for ($i = $start; $i <= $end; $i++) {
			if ($i % 2 !== 0) {
				$odds[] = $i;
			}
		}
		return $odds;
	}



	// • === format »
	public static function format($number, $decimal = 0, $separator = ',', $pointer = '.')
	{
		return number_format($number, $decimal, $pointer, $separator);
	}



	// • === round »
	public static function round($number, $decimal = 2)
	{
		$number = round($number, $decimal);
		return (float) $number;
	}



	// • === decimal »
	public static function decimal($number, $option = 'number', $separator = '.')
	{
		// $decimalPart = StringX::after((string)$number, $separator);

		if ($option === 'number') {
			return $decimalPart ?? false;
		}

		// return !is_null($decimalPart) ? strlen($decimalPart) : 0;
	}
} //> end of class ~ NumberX