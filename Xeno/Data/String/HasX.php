<?php //*** HasX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\String;

use Groy\Xeno\Data\StringX;
use Illuminate\Support\Str;

class HasX
{
	// • === number »
	public static function number($var)
	{
		return preg_match('/\d/', $var) === 1;
	}



	// • === character »
	public static function character($var, $ignoreSpace = true)
	{
		if ($ignoreSpace) {
			return preg_match('/[^a-zA-Z0-9\s]/', $var) === 1;
		}
		return preg_match('/[^a-zA-Z0-9]/', $var) === 1;
	}



	// • === letter »
	public static function letter($var)
	{
		return preg_match('/[a-zA-Z]/', $var) === 1;
	}



	// • === space »
	public static function space($var)
	{
		return (strpos(trim($var), ' ') !== false);
	}



	// • === newline »
	public static function newline($var)
	{
		return (strpos($var, "\n") !== false || strpos($var, "\r\n") !== false || strpos($var, "\r") !== false);
	}



	// • === paragraph »;
	public static function paragraph($var)
	{
		return (preg_match('/(\R){2,}/', $var));
	}
} //> end of class ~ HasX