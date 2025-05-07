<?php //*** SpaceX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;

class SpaceX
{
	// • === no → remove any space »
	public static function no($string)
	{
		return SwapX::all($string, ' ', '');
	}





	// • === single » allow single spaces
	public static function single($string)
	{
		if (!StringX::valid($string)) {
			return false;
		}

		return preg_replace('/\s+/', ' ', $string);
	}





	// • === upper »
	public static function upper($string)
	{
		return CaseX::upperToSpace($string);
	}





	// • === lower »
	public static function lowerToSpace($string)
	{
		return CaseX::lowerToSpace($string);
	}
} //> end of class ~ SpaceX