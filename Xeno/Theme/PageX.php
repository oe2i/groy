<?php //*** PageX ~ class. » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Theme;

use Groy\Spine\Ally\BladeX;

class PageX
{
	// • === prepare »
	public static function prepare($file)
	{
		return ThemeX::prepare('page', $file);
	}



	// • === oreo »
	public static function oreo($page, $check = true)
	{
		// ➝ auth
		if (in_array($page, ['login', 'register'])) {
			$page = 'auth.' . $page;
		}

		$page = self::prepare($page);
		if ($check) {
			return BladeX::safe($page);
		}
		return $page;
	}
} //> end of class ~ PageX;