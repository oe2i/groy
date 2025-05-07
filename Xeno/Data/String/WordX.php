<?php //*** WordX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;
use Illuminate\Support\Str;

class WordX
{
	// • === first »
	public static function first($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return Str::words($string, 1);
	}





	// • === count »
	public static function count($string, $character = null)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return str_word_count($string, $character);
	}





	// • === limit » limit number of words
	public static function limit($string, $noOfWords)
	{
		if (!StringX::valid($string) || !is_numeric($noOfWords)) {
			return false;
		}

		return Str::words($string, $noOfWords);
	}
} //> end of class ~ WordX