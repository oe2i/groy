<?php //*** BladeX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Vine;

use Illuminate\Support\Facades\View;
use Groy\Xeno\Data\StringX;
use Groy\Xeno\Core\DebugX;

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
	public static function e404($blade, $label = 'BladeX', $message = 'resource unavailable')
	{
		return self::error($message, $blade, $label);
	}




	// • === safe »
	public static function safe($blade, $label = 'BladeX', $message = null)
	{
		if (self::is($blade)) {
			return $blade;
		}
		if (!$message) {
			return self::e404($blade, $label);
		}
		return self::e404($blade, $label, $message);
	}




	// • === format »
	public static function format($blade)
	{
		return StringX::swap()->all($blade, '/', '.');
	}

} //> end of class ~ BladeX