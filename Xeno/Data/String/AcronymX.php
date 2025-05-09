<?php //*** AcronymX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;

class AcronymX
{
	// ◇ === has »
	public static function has($string)
	{
		if (!StringX::verified($string)) {
			return false;
		}

		return preg_match('/[A-Z]{2,}/', $string);
	}





	// ◇ === grab » used to grab upper case words
	public static function grab($string)
	{
		if (!StringX::verified($string)) {
			return false;
		}

		preg_match_all('/[A-Z]{2,}/', $string, $matches, PREG_OFFSET_CAPTURE);

		if (empty($matches[0])) {
			return [];
		}

		$var = [];

		foreach ($matches[0] as [$acronym, $position]) {
			$var[] = [
				'acronym' => $acronym,
				'position' => $position,
			];
		}

		return $var;
	}

} //> end of class ~ AcronymX