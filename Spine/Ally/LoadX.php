<?php //*** LoadX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//
namespace Groy\Spine\Ally;

use Groy\Spine\Core\PathX;

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
} //> end of class ~ LoadX