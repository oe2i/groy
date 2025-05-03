<?php //*** PathX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Core;

use Groy\Xeno\Trait\StaticX;
use Groy\Xeno\Data\String\BeginX;
use Groy\Xeno\Data\String\CropX;

class PathX
{
	// • trait
	use StaticX;




	// • property
	private static bool $init = false;
	private static string $ds = DIRECTORY_SEPARATOR;
	private static string $ps = '/';
	private static string $oreo = 'oreo';




	// • === init »
	private static function init()
	{
		if (!self::$init) {
			self::$oreo = strtolower(EnvX::theme());
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
	public static function router(string $path = 'oreo::web')
	{
		self::init();

		if (BeginX::with($path, 'oreo')) {
			$path = self::oreo($path);
		}

		if (BeginX::with($path, 'debug')) {
			$path = self::debug($path);
		}

		if (is_string($path)) {
			$path = 'routes' . BeginX::ifNot($path, self::$ds);
			$path = self::base($path);
		}

		if (is_array($path)) {
			foreach ($path as $key => $value) {
				$value = 'routes' . BeginX::ifNot($value, self::$ds);
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




	// • === oreo »
	private static function oreo(string $path)
	{
		self::init();
		$oreo = self::$oreo . self::$ds;

		if ($path === 'oreo::api') {
			return $oreo . 'api.php';
		}

		if ($path === 'oreo::app') {
			return $oreo . 'app.php';
		}

		if ($path === 'oreo::site') {
			return $oreo . 'site.php';
		}

		if ($path === 'oreo::web') {
			return [
				'app' => $oreo . 'app.php',
				'site' => $oreo . 'site.php'
			];
		}

		return $oreo . CropX::begin($path, self::$ds);
	}




	// • === debug »
	private static function debug(string $path)
	{
		self::init();
		$debug = self::oreo('debug' . self::$ds);

		if ($path === 'debug::api') {
			$path = $debug . 'api.php';
		} elseif ($path === 'debug::app') {
			$path = $debug . 'app.php';
		} else {
			$path = $debug . CropX::begin($path, self::$ds);
		}

		return $path;
	}
} //> end of class ~ PathX