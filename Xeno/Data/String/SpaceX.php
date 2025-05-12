<?php //*** SpaceX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Trait\FluentX;
use Groy\Xeno\Data\StringX;

class SpaceX
{
	// ◇ trait
	use FluentX;





	// ◇ === has »
	public static function has($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return (strpos(trim($string), ' ') !== false);
	}





	// ◇ === remove » remove any space
	public static function remove($string)
	{
		return SwapX::all($string, ' ', '');
	}





	// ◇ === single » allow single spaces
	public static function single($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return preg_replace('/\s+/', ' ', $string);
	}





	// ◇ === upper » space from uppercase
	public static function upper($string)
	{
		return CaseX::upperToSpace($string);
	}





	// ◇ === lower » space from lowercase
	public static function lower($string)
	{
		return CaseX::lowerToSpace($string);
	}





	// ◇ === to »
	public static function to($string, $substitute, $occurrence = 'all')
	{
		return SwapX::text($string, ' ', $substitute, $occurrence);
	}





	// ◇ === toDot »
	public static function toDot($string, $occurrence = 'all')
	{
		return self::to($string, '.', $occurrence);
	}





	// ◇ === toPS »
	public static function toPS($string, $occurrence = 'all')
	{
		return self::to($string, '/', $occurrence);
	}





	// ◇ === toPS »
	public static function toDS($string, $occurrence = 'all')
	{
		return self::to($string, DIRECTORY_SEPARATOR, $occurrence);
	}





	// ◇ === toHyphen »
	public static function toHyphen($string, $occurrence = 'all')
	{
		return self::to($string, '-', $occurrence);
	}





	// ◇ === toUnderscore »
	public static function toUnderscore($string, $occurrence = 'all')
	{
		return self::to($string, '_', $occurrence);
	}





	// ◇ === toUpper »
	public static function toUpper($string)
	{
		$firstChar = StringX::first($string);
		$string = StripX::nth($string, 1);
		if (StringX::length($string) > 0) {
			return $firstChar . lcfirst(ucwords($string));
		}
		return $firstChar;
	}





	// ◇ === toLower »
	public static function toLower($string)
	{
		$firstChar = StringX::first($string);
		$string = StripX::nth($string, 1);
		if (StringX::length($string) > 0) {
			$words = explode(' ', $string);
			$words = array_map(function ($word) {
				return lcfirst($word);
			}, $words);
			return $firstChar . implode(' ', $words);
		}
		return $firstChar;
	}

} //> end of class ~ SpaceX