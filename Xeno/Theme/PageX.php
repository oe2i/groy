<?php //*** PageX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Theme;

use Groy\Spine\Core\DebugX;
use Groy\Spine\Ally\BladeX;

class PageX
{
	// • === as »
	public static function as($file)
	{
		return ThemeX::as('page', $file);
	}



	// • === oreo »
	public static function oreo($page, $check = true) {

		// ➝ auth
		if (in_array($page, ['login', 'register'])) {
			$page = 'auth.'.$page;
		}

		$page = LayoutX::page($page);

		if($check){
			return BladeX::safe($page);
		}
		return $page;
	}
} //> end of class ~ PageX;