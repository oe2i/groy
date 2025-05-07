<?php //*** CropX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;

class CropX
{
	// • === text » trim edges or character(s)
	public static function text($string, $needle = 'space', $case = false, $recursive = false)
	{
		if (!StringX::verified($string, $needle)) {
			return false;
		}

		if (strtolower($needle) === 'space') {
			return trim($string);
		}

		if (StringX::contain($string, $needle, $case)) {

			$length = strlen($needle);
			if ($length === 1) {
				$string = trim($string, $needle);
			}

			if ($length > 1) {
				if (!$recursive) {
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





	// • === begin » remove beginning of string
	public static function begin($string, $search, $case = false)
	{
		if (BeginX::with($string, $search)) {
			return StripX::first($string, $search, $case);
		}

		return $string;
	}





	// • === end » remove end of string
	public static function end($string, $search, $case = false)
	{
		if (EndX::with($string, $search)) {
			return StripX::last($string, $search, $case);
		}

		return $string;
	}





	// • === beginNth » crop from beginning of string to nth position
	public static function beginNth($string, $nth)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return substr($string, $nth);
	}





	// • === endNth » crop from ending of string to nth position
	public static function endNth($string, $nth)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return substr($string, 0, $nth);
	}
} //> end of class ~ CropX