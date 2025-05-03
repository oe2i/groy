<?php //*** AcronymX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

class AcronymX
{
	// • === grab » used to grab upper case words
	public static function grab($string)
	{
		preg_match_all('/[A-Z]{2,}/', $string, $matches, PREG_OFFSET_CAPTURE);
		$found = $matches[0];
		if (!empty($found) && is_array($found)) {
			$var = [];
			foreach ($found as $key => $match) {
				$var[$key]['acronym'] = $match[0];
				$var[$key]['position'] = $match[1];
				// echo "Found '$matchedText' at position $position\n";
			}
			return $var;
		}
	}



	// • === has »
	public static function has($string)
	{
		// TODO: test & implement code
		return preg_match('/[A-Z]{2,}/', $string);
	}
} //> end of class ~ AcronymX