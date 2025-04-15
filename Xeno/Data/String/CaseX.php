<?php //*** CaseX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;

class CaseX
{
	// • === no → remove any space »
	public static function no($string)
	{
		return SwapX::all($string, ' ', '');
	}



	// • === single → allow aingle spaces » boolean
	public static function single($string)
	{
		return preg_replace('/\s+/', ' ', $string);
	}
} //> end of class ~ CaseX