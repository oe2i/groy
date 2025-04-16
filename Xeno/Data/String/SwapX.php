<?php //*** SwapX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

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




} //> end of class ~ SwapX