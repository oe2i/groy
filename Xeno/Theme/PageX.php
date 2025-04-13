<?php //*** PageX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Theme;

use Groy\Spine\Core\DebugX;

class PageX
{
	// • === as »
	public static function as($file)
	{
		return ThemeX::as('page', $file);
	}





	// • === oreo »
	public static function oreo($page) {

		// ➝ auth
		if (in_array($page, ['login', 'register'])) {
			$page = 'auth.'.$page;
			// return LayoutX::page($page);
		}
	}
} //> end of class ~ PageX;