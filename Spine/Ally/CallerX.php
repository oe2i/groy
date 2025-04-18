<?php //*** CallerX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Spine\Ally;

class CallerX
{
	// • === method »
	public static function method($class, string $method, ...$arguments)
	{
		if (is_object($class) && method_exists($class, $method)) {
			return $class->$method(...$arguments);
		}

		if (is_string($class) && method_exists($class, $method)) {
			return $class::$method(...$arguments);
		}

		return null;
	}
} //> end of class ~ CallerX