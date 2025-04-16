<?php //*** HasX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;
use Illuminate\Support\Str;

class HasX
{
	// • === something »
	public static function something($string)
	{
		return StringX::length($string) > 0;
	}



	// • === nothing »
	public static function nothing($string)
	{
		return (self::something($string) === false);
	}



	// • === number »
	public static function number($string)
	{
		if (self::nothing($string)) {
			return false;
		}
		return preg_match('/\d/', $string) === 1;
	}



	// • === character »
	public static function character($string, $ignoreSpace = true)
	{
		if (self::nothing($string)) {
			return false;
		}

		if ($ignoreSpace) {
			return preg_match('/[^a-zA-Z0-9\s]/', $string) === 1;
		}

		return preg_match('/[^a-zA-Z0-9]/', $string) === 1;
	}



	// • === letter »
	public static function letter($string)
	{
		if (self::nothing($string)) {
			return false;
		}

		return preg_match('/[a-zA-Z]/', $string) === 1;
	}



	// • === space »
	public static function space($string)
	{
		if (self::nothing($string)) {
			return false;
		}

		return (strpos(trim($string), ' ') !== false);
	}



	// • === newline »
	public static function newline($string)
	{
		if (self::nothing($string)) {
			return false;
		}

		return (strpos($string, "\n") !== false || strpos($string, "\r\n") !== false || strpos($string, "\r") !== false);
	}



	// • === paragraph »;
	public static function paragraph($string)
	{
		if (self::nothing($string)) {
			return false;
		}

		return (preg_match('/(\R){2,}/', $string));
	}
} //> end of class ~ HasX