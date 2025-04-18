<?php //*** ThemeX ~ class. » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Theme;

use Groy\Spine\Core\EnvX;
use Groy\Spine\Ally\BladeX;
use Groy\Concept\Trait\StaticX;

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




	// • === prepare »
	public static function prepare($path, $file = null)
	{
		self::init();
		$blade = self::$theme;
		if (in_array($path, ['page', 'layout'])) {
			$blade .= ".{$path}.";
		} elseif ($path != 'theme') {
			// NOTE: repetitive [makeshift] - feature is TODO
			$blade .= '.' . $path;
		}
		$blade .= $file;
		return BladeX::format($blade);
	}
} //> end of class ~ ThemeX