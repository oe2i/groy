<?php //*** EndX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;
use Groy\Xeno\Data\Array\ValueX;

class EndX
{
	// • === with → check string ending » boolean
	public static function with($string, $end, $case = false)
	{
		if (HasX::nothing($string) || HasX::nothing($end)) {
			return false;
		}

		$string = trim($string);

		if (!$case) {
			$string = mb_strtolower($string);
			$end = mb_strtolower($end);
		}

		if (function_exists('str_ends_with') && $case) {
			return str_ends_with($string, $end);
		}

		$length = strlen($end);
		if ($length === 0) {
			return true;
		}

		return substr($string, -$length) === $end;
	}



	// • === withAny → check if string end with anything in array or comma separated string » string, boolean
	public static function withAny($string, $end, $case = false, $return = false)
	{
		if (HasX::nothing($string) || empty($end)) {
			return false;
		}

		if (is_string($end)) {
			if (StringX::in($end, ',')) {
				$end = array_map('trim', explode(',', $end));
			} else {
				$check = self::with($string, $end, $case);
				if ($return && $check) {
					return $end;
				}
				return $check;
			}
		}

		if (!is_array($end)) {
			return false;
		}

		foreach ($end as $suffix) {
			if (self::with($string, $suffix, $case) === true) {
				if ($return) {
					return $suffix;
				}
				return true;
			}
		}

		return false;
	}




	// • === ifNot »
	public static function ifNot($string, $end, $case = false)
	{
		if (!self::with($string, $end, $case)) {
			return $string . $end;
		}
		return $string;
	}




	// • === ifNotAny »
	public static function ifNotAny($string, $end, $case = false)
	{
		if (!self::withAny($string, $end, $case)) {
			if (is_array($end)) {
				$end = ValueX::first($end);
			}
			return $string . $end;
		}
		return $string;
	}




	// • === newline » check if string ends with newline
	public static function newline($string)
	{
		if (HasX::nothing($string)) {
			return false;
		}
		return preg_match('/(\r?\n)$/', $string);
	}
} //> end of class ~ EndX