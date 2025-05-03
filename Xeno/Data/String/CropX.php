<?php //*** CropX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;

class CropX
{
	// • === text → trim edges or character(s) »
	public static function text($string, $needle = 'space', $case = false, $repeated = false)
	{
		if (!StringX::has($string) || !StringX::has($needle)) {
			return false;
		}

		if (strtolower($needle) === 'space') {
			return trim($string);
		}

		if (StringX::in($string, $needle, $case)) {

			$length = strlen($needle);
			if ($length === 1) {
				$string = trim($string, $needle);
			}

			if ($length > 1) {
				if (!$repeated) {
					$pattern = '/^' . preg_quote($needle, '/') . '|' . preg_quote($needle, '/') . '$/';
					return preg_replace($pattern, '', $string);
				} else {

					while (str_starts_with($string, $needle)) {
						$string = substr($string, strlen($needle));
					}

					while (str_ends_with($string, $needle)) {
						$string = substr($string, 0, -strlen($needle));
					}

					return $string;
				}
			}
		}

		return trim($string);
	}




	// • === begin → remove beginning of string »
	public static function begin($string, $needle, $case = false)
	{
		if (BeginX::with($string, $needle)) {
			return StripX::first($string, $needle, $case);
		}
		return $string;
	}




	// • === beginNth → crop from beginning of string to nth position »
	public static function beginNth($string, $nth)
	{
		return substr($string, $nth);
	}




	// • === end → remove end of string »
	public static function end($string, $needle, $case = false)
	{
		if (EndX::with($string, $needle)) {
			return StripX::last($string, $needle, $case);
		}
		return $string;
	}




	// • === endNth → crop from ending of string to nth position »
	public static function endNth($string, $nth)
	{
		return substr($string, 0, $nth);
	}
} //> end of class ~ CropX