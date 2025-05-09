<?php //*** BeginX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;
use Groy\Xeno\Data\Array\ValueX as ArrValueX;

class BeginX
{
	// ◇ === with »
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

		if (function_exists('str_starts_with') && $case) {
			$res = str_starts_with($string, $search);
		} else {
			$res = strpos($string, $search) === 0;
		}

		if ($return && $res) {
			return $search;
		}

		return $res;
	}





	// ◇ === withAny »
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





	// ◇ === ifNot »
	public static function ifNot($string, $search, $prefix = null, $case = false)
	{
		if (!self::with($string, $search, false, $case)) {

			if ($prefix) {
				return $prefix . $string;
			}

			return $search . $string;
		}

		return $string;
	}





	// ◇ === ifNotAny »
	public static function ifNotAny($string, $search, $prefix = null, $case = false)
	{
		if (!is_array($search)) {
			return self::ifNot($string, $search, $prefix, $case);
		}

		if (!self::withAny($string, $search, false, $case)) {

			if ($prefix) {
				return $prefix . $string;
			}

			return ArrValueX::first($search) . $string;
		}

		return $string;
	}





	// ◇ === newline »
	public static function newline($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return preg_match('/^(?!\r\n|\r|\n)/', $string);
	}

} //> end of class ~ BeginX