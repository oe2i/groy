<?php //*** ThemeX ~ class. » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Skin;

use Groy\Xeno\Trait\StaticX;
use Groy\Xeno\Core\EnvX;
use Groy\Xeno\Vine\BladeX;

class ThemeX
{
	// • trait
	use StaticX;


	// • property
	private static bool $init = false;
	private static string $theme;




	// • === init »
	private static function init()
	{
		if (!self::$init) {
			self::$theme = strtolower(EnvX::theme());
			self::$init = true;
		}
	}




	// • === name »
	public static function name()
	{
		self::init();
		return self::$theme;
	}




	// • === prepare »
	public static function prepare($path, $file = null)
	{
		self::init();
		$blade = self::$theme;
		if (in_array($path, ['page', 'site', 'slab', 'layout'])) {
			$blade .= ".{$path}.";
		} elseif ($path != 'theme') {
			// NOTE: repetitive [makeshift] - feature is TODO
			$blade .= '.' . $path;
		}
		$blade .= $file;
		return BladeX::format($blade);
	}
} //> end of class ~ ThemeX