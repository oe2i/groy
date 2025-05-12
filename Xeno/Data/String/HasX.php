<?php //*** HasX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;

class HasX
{
	// • === something »
	public static function something($string)
	{
		return StringX::valid($string);
	}





	// • === nothing »
	public static function nothing($string)
	{
		return StringX::empty($string);
	}





	// • === number »
	public static function number($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return preg_match('/\d/', $string) === 1;
	}





	// • === character »
	public static function character($string, $ignoreSpace = true)
	{
		if (!StringX::valid($string)) {
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
		if (!StringX::valid($string)) {
			return false;
		}

		return preg_match('/[a-zA-Z]/', $string) === 1;
	}





	// ◇ === space »
	public static function space($string)
	{
		return SpaceX::has($string);
	}





	// • === newline »
	public static function newline($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return (strpos($string, "\n") !== false || strpos($string, "\r\n") !== false || strpos($string, "\r") !== false);
	}





	// • === paragraph »
	public static function paragraph($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return (preg_match('/(\R){2,}/', $string));
	}





	// • === uppercase »
	public static function uppercase($string)
	{
		return CaseX::hasUpper($string);
	}





	// • === lowercase »
	public static function lowercase($string)
	{
		return CaseX::hasLower($string);
	}





	// • === mixedcase »
	public static function mixedcase($string)
	{
		return CaseX::hasMixed($string);
	}





	// • === onlyUppercase »
	public static function onlyUppercase($string)
	{
		return self::only($string, 'uppercase');
	}





	// • === onlyLowercase »
	public static function onlyLowercase($string)
	{
		return self::only($string, 'lowercase');
	}





	// • === onlyAlphaNumeric »
	public static function onlyAlphaNumeric($string)
	{
		return self::only($string, 'alphanumeric');
	}





	// • === onlyLetter » can be used for One-Word check
	public static function onlyLetter($string)
	{
		return self::only($string, 'letter');
	}





	// • === onlyNumber »
	public static function onlyNumber($string)
	{
		return self::only($string, 'number');
	}





	// • === only »
	private static function only($string, $flag)
	{
		if (!StringX::verified($string, $flag)) {
			return false;
		}

		if ($flag === 'uppercase') {
			return CaseX::isUpper($string);
		}

		if ($flag === 'lowercase') {
			return CaseX::isLower($string);
		}

		if ($flag === 'mixedcase') {
			return CaseX::isMixed($string);
		}

		if ($flag === 'alphanumeric') {
			return ctype_alnum($string);
		}

		if ($flag === 'letter') {
			return ctype_alpha($string);
		}

		if ($flag === 'number') {
			return ctype_digit($string);
		}
	}

} //> end of class ~ HasX