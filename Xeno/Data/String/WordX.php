<?php //*** WordX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;
use Illuminate\Support\Str;

class WordX
{
	// • === firstWord »
	public static function first($string)
	{
		if (HasX::nothing($string)) {
			return false;
		}
		return Str::words($string, 1);
	}



	// • === count »
	public static function count($string)
	{
		if (HasX::nothing($string)) {
			return false;
		}
		return str_word_count($string);
	}



	// • === limit » limit number of words
	public static function limit($string, $noOfWords)
	{
		if (HasX::nothing($string) || !is_numeric($noOfWords)) {
			return false;
		}

		return Str::words($string, $noOfWords);
	}
} //> end of class ~ WordX