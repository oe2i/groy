<?php //*** LoadX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Core;

use Illuminate\Support\Str;

class LoadX
{
	// • === file » load file or files
	public static function file($file, $check = true, $label = 'LoadX')
	{

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
		if (empty($count)) {
			return $o;
		}

		if ($check) {
			return DebugX::oversight('LoadX', Str::plural('file', $count) . ' unavailable', $file);
		}
	}




	// • === directory » file or files in a directory
	public static function directory($directory, $check = false, $extension = 'php')
	{
		if (is_dir($directory)) {
			$files = glob($directory . '*.' . $extension);
			if ($check === 'directory') {
				$check = false;
			}
			return self::file($files, $check);
		}

		if ($check === true || $check === 'directory') {
			return DebugX::oversight('LoadX', 'directory' . ' unavailable', $directory);
		}
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




	// • === oreo »
	public static function oreo($path)
	{
		return self::route('oreo::' . $path);
	}




	// • === debug »
	public static function debug($path)
	{
		if (!EnvX::prod()) {
			return self::route('debug::' . $path);
		}
		return null;
	}

} //> end of class ~ LoadX