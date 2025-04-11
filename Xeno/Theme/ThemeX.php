<?php //*** ThemeX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Theme;

use Groy\Spine\Core\EnvX;
use Groy\Concept\Trait\StaticX;
use Groy\Xeno\Data\StringX;

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



	// ◈ === format »
	private static function format($path)
	{
		if (!empty($path)) {
			// TODO: implement
			// $path = StringX::swap($path, '/', '.');
		}
		return $path;
	}



	// ◈ === as »
	public static function as($path, $file = null)
	{
		self::init();
		$location = self::$theme;
		if (in_array($path, ['page', 'layout'])) {
			$location .= ".{$path}.";
		} elseif ($path != 'theme') {
			// NOTE: repetitive [makeshift] - feature is TODO
			$location .= '.' . $path;
		}
		$location .= $file;
		return self::format($location);
	}



	// ◈ === is »
	public static function is()
	{
		self::init();
		return self::$theme;
	}
} //> end of class ~ ThemeX