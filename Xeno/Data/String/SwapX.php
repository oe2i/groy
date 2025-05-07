<?php //*** SwapX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;

class SwapX
{
	// • === text »
	public static function text($string, $search, $substitute, $occurrence = 'all', $case = false)
	{
		$occurrence = !empty($occurrence) ? strtolower($occurrence) : $occurrence;

		if (!StringX::contain($string, $search, $case)) {
			return $string;
		}

		if ($occurrence === 'all') {
			return $case
				? str_replace($search, $substitute, $string)
				: str_ireplace($search, $substitute, $string);
		}

		switch ($occurrence) {
			case 'first':
				$pos = $case ? strpos($string, $search) : stripos($string, $search);
				break;
			case 'last':
				$pos = $case ? strrpos($string, $search) : strripos($string, $search);
				break;
			default:
				return $string;
		}

		if ($pos !== false) {
			return substr_replace($string, $substitute, $pos, strlen($search));
		}

		return $string;
	}





	// • === all » all occurrence
	public static function all($string, $search, $substitute = '', $case = false)
	{
		return self::text($string, $search, $substitute, 'all', $case);
	}





	// • === first » first occurrence
	public static function first($string, $search, $substitute = '', $case = false)
	{
		return self::text($string, $search, $substitute, 'first', $case);
	}




	// • === last » last occurrence
	public static function last($string, $search, $substitute = '', $case = false)
	{
		return self::text($string, $search, $substitute, 'last', $case);
	}





	// • === ds » directory separator
	public static function ds($string, $substitute, $occurrence = 'all')
	{
		return self::text($string, DIRECTORY_SEPARATOR, $substitute, $occurrence);
	}





	// • === ps » path separator
	public static function ps($string, $substitute, $occurrence = 'all')
	{
		return self::text($string, '/', $substitute, $occurrence);
	}





	// • === hyphen »
	public static function hyphen($string, $substitute, $occurrence = 'all')
	{
		return self::text($string, '-', $substitute, $occurrence);
	}





	// • === space » replace space with character & vice-versa
	public static function space($string, $search, $inverse = false)
	{
		if ($inverse) {
			return StringX::contain($string, $search) ? self::text($string, $search, ' ') : $string;
		}

		return StringX::contain($string, 'space') ? self::text($string, ' ', $search) : $string;
	}





	// • === withSpace » replace character with space
	public static function withSpace($string, $search)
	{
		return self::space($string, $search, true);
	}





	// • === ico2png » replace .ico with .png
	public static function ico2png($string, $inverse = false)
	{
		if ($inverse) {
			return self::last($string, '.png', '.ico');
		}
		return self::last($string, '.ico', '.png');
	}





	// • === beginIf » swap if string begins with needle
	public static function beginIf($string, $search, $substitute, $case = false)
	{
		if (BeginX::with($string, $search, $case)) {
			$string = self::first($string, $search, $substitute, $case);
		}

		return $string;
	}





	// • === endIf » swap if string ends with needle
	public static function endIf($string, $search, $substitute, $case = false)
	{
		if (EndX::with($string, $search, $case)) {
			$string = self::last($string, $search, $substitute, $case);
		}

		return $string;
	}
} //> end of class ~ SwapX