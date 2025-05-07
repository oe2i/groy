<?php //*** EndX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;
use Groy\Xeno\Data\Array\ValueX as StrValueX;

class EndX
{
	// • === with »
	public static function with($string, $search, $return = false, $case = false): bool|int|string
	{
		if (!StringX::verified($string, $search)) {
			return false;
		}

		$string = trim($string);

		if (!$case) {
			$string = mb_strtolower($string);
			$search = mb_strtolower($search);
		}

		if (function_exists('str_ends_with') && $case) {
			$res = str_ends_with($string, $search);
		} else {
			$length = strlen($search);

			if ($length === 0) {
				return true;
			}

			$res = substr($string, -$length) === $search;
		}

		if ($return && $res) {
			return $search;
		}

		return $res;
	}





	// • === withAny → check if string end with anything in array or comma separated string » string, boolean
	public static function withAny($string, $search, $return = false, $case = false)
	{
		if (!StringX::valid($string) || empty($search)) {
			return false;
		}

		if (is_string($search)) {
			if (StringX::in($search, ',')) {
				$search = array_map('trim', explode(',', $search));
			} else {
				return self::with($string, $search, $return, $case);
			}
		}

		if (!is_array($search)) {
			return false;
		}

		foreach ($search as $needle) {
			if (self::with($string, $needle, false, $case) === true) {

				if ($return) {
					return $needle;
				}

				return true;
			}
		}

		return false;
	}





	// • === ifNot »
	public static function ifNot($string, $search, $suffix = null, $case = false)
	{
		if (!self::with($string, $search, false, $case)) {

			if ($suffix) {
				return $string . $suffix;
			}

			return $string . $search;
		}

		return $string;
	}





	// • === ifNotAny »
	public static function ifNotAny($string, $search, $suffix = null, $case = false)
	{
		if (!is_array($search)) {
			return self::ifNot($string, $search, $suffix, $case);
		}

		if (!self::withAny($string, $search, false, $case)) {

			if ($suffix) {
				return $string . $suffix;
			}

			return $string . StrValueX::first($search);
		}

		return $string;
	}





	// • === newline » check if string ends with newline
	public static function newline($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return preg_match('/(\r?\n)$/', $string);
	}
} //> end of class ~ EndX