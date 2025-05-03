<?php //*** SwapX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;

class SwapX
{
	// • === text »
	public static function text($string, $needle, $substitute, $occurrence = 'all', $case = false)
	{
		$occurrence = strtolower($occurrence);

		if (!StringX::in($string, $needle, $case)) {
			return $string;
		}

		if ($occurrence === 'all') {
			return $case
				? str_replace($needle, $substitute, $string)
				: str_ireplace($needle, $substitute, $string);
		}

		switch ($occurrence) {
			case 'first':
				$pos = $case ? strpos($string, $needle) : stripos($string, $needle);
				break;
			case 'last':
				$pos = $case ? strrpos($string, $needle) : strripos($string, $needle);
				break;
			default:
				return $string;
		}

		if ($pos !== false) {
			return substr_replace($string, $substitute, $pos, strlen($needle));
		}

		return $string;
	}



	// • === ds → directory separator »
	public static function ds($string, $substitute, $occurrence = 'all')
	{
		return self::text($string, DIRECTORY_SEPARATOR, $substitute, $occurrence);
	}



	// • === ps → path separator »
	public static function ps($string, $substitute, $occurrence = 'all')
	{
		return self::text($string, '/', $substitute, $occurrence);
	}




	// • === hyphen »
	public static function hyphen($string, $substitute, $occurrence = 'all')
	{
		return self::text($string, '-', $substitute, $occurrence);
	}



	// • === all → all occurrence »
	public static function all($string, $needle, $substitute = '', $case = false)
	{
		return self::text($string, $needle, $substitute, 'all', $case);
	}



	// • === first → first occurrence »
	public static function first($string, $needle, $substitute = '', $case = false)
	{
		return self::text($string, $needle, $substitute, 'first', $case);
	}



	// • === last → last occurrence »
	public static function last($string, $needle, $substitute = '', $case = false)
	{
		return self::text($string, $needle, $substitute, 'last', $case);
	}



	// • === space → replace space with character & vice-versa »
	public static function space($string, $needle, $inverse = false)
	{
		if ($inverse) {
			return StringX::in($string, $needle) ? self::text($string, $needle, ' ') : $string;
		}
		return StringX::contain($string, 'space') ? self::text($string, ' ', $needle) : $string;
	}



	// • === withSpace → replace character with space »
	public static function withSpace($string, $needle)
	{
		return self::space($string, $needle, true);
	}




	// • === ico2png → replace .ico with .png »
	public static function ico2png($string, $inverse = false)
	{
		if ($inverse) {
			return self::last($string, '.png', '.ico');
		}
		return self::last($string, '.ico', '.png');
	}




	// • === beginIf » swap if string begins with needle
	public static function beginIf($string, $needle, $substitute, $case = false)
	{
		if (BeginX::with($string, $needle, $case)) {
			$string = self::first($string, $needle, $substitute, $case);
		}
		return $string;
	}




	// • === endIf » swap if string ends with needle
	public static function endIf($string, $needle, $substitute, $case = false)
	{
		if (EndX::with($string, $needle, $case)) {
			$string = self::last($string, $needle, $substitute, $case);
		}
		return $string;
	}




} //> end of class ~ SwapX