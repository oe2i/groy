<?php //*** LoadX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//
namespace Groy\Spine\Ally;

use Groy\Spine\Core\PathX;
use Groy\Spine\Ally\BladeX;

class LoadX
{
	// • === route »
	public static function route(string $path = '', ?string $to = null)
	{
		$file = PathX::router($path);
		$file = !empty($file) ? $file : $path;

		if (is_string($file) && is_dir($file)) {
			// TODO: make sure path is not ending with '//'
			$file = glob($file . PathX::property('DS') . '*.php');
		}

		if (is_string($file) && is_file($file)) {
			return require $file;
		}

		if (is_array($file)) {
			foreach ($file as $filename) {
				if (is_file($filename)) {
					require $filename;
				}
			}
		}
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