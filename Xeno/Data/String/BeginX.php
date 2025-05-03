<?php //*** BeginX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;

class BeginX
{
	// • === with → check string beginning » boolean
	public static function with($string, $begin, $case = false)
	{
		if (HasX::nothing($string) || HasX::nothing($begin)) {
			return false;
		}

		$string = trim($string);

		if (!$case) {
			$string = mb_strtolower($string);
			$begin = mb_strtolower($begin);
		}

		if (function_exists('str_starts_with') && $case) {
			return str_starts_with($string, $begin);
		}

		return strpos($string, $begin) === 0;
	}




	// • === withAny → check if string begin with anything in array or comma separated string » string, boolean
	public static function withAny($string, $begin, $case = false)
	{
		if (HasX::nothing($string) || empty($begin)) {
			return false;
		}

		if (is_string($begin)) {
			if (StringX::in($begin, ',')) {
				$begin = array_map('trim', explode(',', $begin));
			} else {
				return self::with($string, $begin, $case);
			}
		}

		if (!is_array($begin)) {
			return false;
		}

		foreach ($begin as $prefix) {
			if (self::with($string, $prefix, $case) === true) {
				return true;
			}
		}

		return false;
	}




	// • === ifNot » add begning if it is not already there
	public static function ifNot($string, $begin, $case = false)
	{
		if (HasX::something($string) && HasX::something($begin) && !self::with($string, $begin, $case)) {
			return $begin . $string;
		}
		return $string;
	}
} //> end of class ~ BeginX