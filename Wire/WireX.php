<?php //*** WireX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Wire;

use Groy\Xeno\Core\DebugX;

class WireX
{
	// • === error »
	public static function error($message, $extra = null, $label = 'WireX')
	{
		return DebugX::oversight($label, $message, $extra);
	}



	// • === e404 »
	public static function e404($file, $message = 'component unavailable', $wire = null)
	{
		if (!empty($wire)) {
			$file = ['Path' => $file, 'Wire' => $wire];
		}
		return self::error($message, $file);
	}
} //> end of class ~ WireX