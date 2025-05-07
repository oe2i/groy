<?php //*** CaseX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;
use Groy\Xeno\Data\RandomX;

class CaseX
{
	// • === upper »
	public static function upper($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return strtoupper($string);
	}





	// • === lower »
	public static function lower($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return strtolower(trim($string));
	}





	// • === sentence →
	public static function sentence($string, $acronym = true, $caps = true)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		// TODO:: Implement code

		// if ($acronym) {
		// 	$found = AcronymX::grab($string);
		// 	if (is_array($found) && !empty($found)) {
		// 		foreach ($found as $key => $row) {
		// 			$swap = '_' . RandomX::numeric(10) . '_';
		// 			$found[$key]['swap'] = $swap;
		// 			$string = SwapX::first($string, $row['acronym'], $swap);
		// 		}

		// 		$string = strtolower($string);

		// 		foreach ($found as $row) {
		// 			$string = SwapX::first($string, $row['swap'], $row['acronym']);
		// 		}
		// 	} else {
		// 		$string = strtolower($string);
		// 	}
		// } else {
		// 	$string = strtolower($string);
		// }

		return ucfirst($string);
	}





	// • === snake →
	public static function snake($string, $separator = null)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		$separator = !empty($separator) ? $separator : ' ';
		$words = explode($separator, $string);

		foreach ($words as $key => $word) {
			if (self::isUpper($word)) {
				$words[$key] = strtolower($word);
			}
		}

		$string = implode(' ', $words);
		$string = preg_replace('/\s+/u', '', ucwords($string));
		$string = preg_replace('/(.)(?=[A-Z])/u', '$1_', $string);

		return strtolower($string);
	}




	/// • === camel →
	public static function camel($string, $separator = null, $strip = true)
	{
		if (!empty($separator)) {
			$words = explode($separator, $string);
			foreach ($words as $key => $word) {
				if (self::isUpper($word)) {
					$words[$key] = strtolower($word);
				}
				$string = implode(' ', $words);
			}
		}

		if (!$strip) {
			$string = SwapX::all($string, ' ', ' ' . $separator);
		}

		$string = !$strip ? ucwords($string, $separator) : ucwords($string);
		$string = str_replace(' ', '', $string);

		return lcfirst($string);
	}





	// • === capitalize →
	public static function capitalize($string, $separator = null)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		if (StringX::valid($separator)) {
			return ucwords($string, $separator);
		}

		return ucwords($string);
	}





	// • === firstCap »
	public static function firstCap($string, $only = false)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		if ($only) {
			$string = strtolower($string);
		}

		return ucfirst($string);
	}





	// • === upperCount →
	public static function upperCount($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return preg_match_all('/[A-Z]/', $string);
	}





	// • === lowerCount →
	public static function lowerCount($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return preg_match_all('/[a-z]/', $string);
	}





	// • === upperToSpace →
	public static function upperToSpace($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return preg_replace('/([a-z])([A-Z])/', '$1 $2', $string);
	}





	// • === lowerToSpace →
	public static function lowerToSpace($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return preg_replace('/([A-Z])([a-z])/', '$1 $2', $string);
	}





	// • === isUpper »
	public static function isUpper($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return ctype_upper($string);
	}





	// • === isLower »
	public static function isLower($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return ctype_lower($string);
	}





	// • === isMixed »
	public static function isMixed($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return (preg_match('/[a-z]/', $string) && preg_match('/[A-Z]/', $string));
	}





	// • === getUpper → get upper case letter & positions » array, boolean [false]
	public static function getUpper($string)
	{
		return self::grab($string, 'upper');
	}





	// • === getLower → get lower case letter & positions » array, boolean [false]
	public static function getLower($string)
	{
		return self::grab($string, 'lower');
	}





	// • === grab »
	private static function grab($string, $case)
	{
		if (!StringX::valid($string) || empty($case)) {
			return false;
		}

		if ($case === 'lower') {
			preg_match_all('/[a-z]/', $string, $matches, PREG_OFFSET_CAPTURE);
		}

		if ($case === 'upper') {
			preg_match_all('/[A-Z]/', $string, $matches, PREG_OFFSET_CAPTURE);
		}

		if (!empty($matches[0])) {
			$matches = $matches[0];
			$grab = [];

			foreach ($matches as $match) {
				$grab[$match[1]] = $match[0];
			}

			return $grab;
		}

		return false;
	}
} //> end of class ~ CaseX