<?php //*** BladeX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Spine\Ally;

use Groy\Spine\Core\DebugX;
use Illuminate\Support\Facades\View;

class BladeX
{
	// • === is »
	public static function is($blade)
	{
		return View::exists($blade);
	}



	// • === error »
	public static function error($message, $extra = null, $label = 'BladeX')
	{
		return DebugX::oversight($label, $message, $extra);
	}



	// • === e404 »
	public static function e404($blade, $message = 'resource unavailable')
	{
		return self::error($message, $blade);
	}



	// • === safe »
	public static function safe($blade, $message = 'resource unavailable', $label = 'BladeX'){
		if(self::is($blade)){
			return $blade;
		}
		return self::e404($blade, $message, $blade);
	}

} //> end of class ~ BladeX