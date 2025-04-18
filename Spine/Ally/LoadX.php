<?php //*** LoadX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Spine\Ally;

use Groy\Spine\Core\PathX;
use Groy\Xeno\Data\StringX;
use Groy\Spine\Core\DebugX;
// use Groy\Spine\Ally\BladeX;

class LoadX
{
	// • === file »
	public static function file($file, $label = 'LoadX'){

		if (is_string($file)) {
			$file = [$file];
		}

		foreach ($file as $key => $filename) {
			if (is_file($filename)) {
				unset($file[$key]);
				$o = require $filename;
			}
		}

		$count = count($file);
		if(empty($count)){
			return $o;
		}

		return DebugX::oversight('LoadX', StringX::plural('file', $count).' unavailable', $file);
	}



	// • === route »
	public static function route(string $path = '', ?string $to = null)
	{
		$file = PathX::router($path);
		$file = !empty($file) ? $file : $path;
		if (is_string($file) && is_dir($file)) {
			$file = glob($file . PathX::property('DS') . '*.php');
		}
		return self::file($file);
	}



	// • === check »
	public static function check($blade, $e404 = true)
	{
		if (!BladeX::is($blade)) {
		}
		if ($e404) {
			return BladeX::e404($blade);
		}
		return false;
	}
} //> end of class ~ LoadX