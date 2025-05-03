<?php //*** StripX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

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

		if (HasX::nothing($string) || $nth <= 0 || $nth > $length || $number <= 0) {
			return $string;
		}

		if ($nth + $number - 1 > $length) {
			$number = $length - $nth + 1;
		}

		return substr($string, 0, $nth - 1) . substr($string, $nth - 1 + $number);
	}




	// • === paragraph » remove empty paragraph
	public static function paragraph($string)
	{
		return preg_replace('/<p>\s*<\/p>/', '', $string);
	}




	// • === newline » remove empty line
	public static function newline($string)
	{
		return preg_replace('/^\s*$(\r\n|\r|\n)/m', '', $string);
	}




	// • === beginIf » if string begins with needle
	public static function beginIf($string, $needle, $case = false)
	{
		if (BeginX::with($string, $needle, $case)) {
			$string = self::first($string, $needle, $case);
		}
		return $string;
	}




	// • === endIf » if string ends with needle
	public static function endIf($string, $needle, $case = false)
	{
		if (EndX::with($string, $needle, $case)) {
			$string = self::last($string, $needle, $case);
		}
		return $string;
	}
} //> end of class ~ StripX