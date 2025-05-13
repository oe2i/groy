<?php //*** PathX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Core;

use Groy\Xeno\Trait\StaticX;
use Groy\Xeno\Data\String\EndX as StrEndX;
use Groy\Xeno\Data\String\CropX as StrCropX;
use Groy\Xeno\Data\String\BeginX as StrBeginX;
use Groy\Xeno\Data\StringX;

class PathX
{
	// • trait
	use StaticX;




	// • property
	private static bool $init = false;
	private static string $ds = DIRECTORY_SEPARATOR;
	private static string $ps = '/';
	private static string $theme = 'oreo';




	// • === init »
	private static function init()
	{
		if (!self::$init) {
			self::$theme = strtolower(EnvX::theme());
			self::$init = true;
		}
	}




	// • === base »
	public static function base(string $path = '')
	{
		return base_path($path);
	}




	// • === app »
	public static function app(string $path = '')
	{
		return app_path($path);
	}




	// • === config »
	public static function config(string $path = '')
	{
		return config_path($path);
	}




	// • === database »
	public static function database(string $path = '')
	{
		return database_path($path);
	}




	// • === lang »
	public static function lang(string $path = '')
	{
		return lang_path($path);
	}




	// • === public »
	public static function public(string $path = '')
	{
		return public_path($path);
	}




	// • === resource »
	public static function resource(string $path = '')
	{
		return resource_path($path);
	}




	// • === storage »
	public static function storage(string $path = '')
	{
		return storage_path($path);
	}




	// • === router »
	public static function router(string $path = 'theme::web')
	{
		self::init();

		if (StrBeginX::with($path, 'theme')) {
			$path = self::theme($path);
		}

		if (StrBeginX::with($path, 'debug')) {
			$path = self::debug($path);
		}

		if (is_string($path)) {
			$path = 'routes' . StrBeginX::ifNot($path, self::$ds);
			$path = self::base($path);
		}

		if (is_array($path)) {
			foreach ($path as $key => $value) {
				$value = 'routes' . StrBeginX::ifNot($value, self::$ds);
				$path[$key] = self::base($value);
			}
		}
		return $path;
	}




	// • === directory » utility to check & return as directory
	public static function directory(bool $check = true)
	{
		$class = static::class;

		return new class ($class, $check) {
			private static string $class;
			private static bool $check;

			public function __construct($class, $check)
			{
				self::$class = $class;
				self::$check = $check;
			}


			public static function __callStatic($name, $arguments)
			{
				$path = call_user_func_array([self::$class, $name], $arguments);

				if (substr($path, -1) !== self::$class::property('ds')) {
					$path .= self::$class::property('ds');
				}

				if (self::$check && !is_dir($path)) {
					DebugX::oversight('PathX', 'not a directory', $path);
				}

				return $path;
			}
		};
	}





	// ◇ === theme »
	private static function theme(string $path)
	{
		self::init();
		$theme = self::$theme . self::$ds;

		if (StringX::contain($path, '::') && StringX::after($path, '::')) {
			$file = StringX::after($path, '::');
			if (in_array($file, ['auth', 'verified'])) {
				$file = 'groy' . DIRECTORY_SEPARATOR . $file;
			}

			if ($file) {
				$file = $theme . $file;
			}

			return StrEndX::ifNot($file, '.php');
		}

		return $theme . StrCropX::begin($path, self::$ds);
	}




	// • === debug »
	private static function debug(string $path)
	{
		self::init();
		$debug = self::theme('debug' . self::$ds);

		if ($path === 'debug::api') {
			$path = $debug . 'api.php';
		} elseif ($path === 'debug::app') {
			$path = $debug . 'app.php';
		} else {
			$path = $debug . StrCropX::begin($path, self::$ds);
		}

		return $path;
	}
} //> end of class ~ PathX