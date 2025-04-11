<?php //*** PathX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Spine\Core;

use Groy\Concept\Trait\StaticX;

class PathX
{
	// • trait
	use StaticX;


	// • property
	private static bool $init = false;
	private static string $DS = DIRECTORY_SEPARATOR;
	private static string $PS = '/';



	// • === init »
	private static function init()
	{
		if (!self::$init) {
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



	// • === route »
	public static function route(string $path = '')
	{
		self::init();
		if (!empty($path)) {
			$path = self::$DS . $path;
		}
		$path = 'routes' . $path;
		return self::base($path);
	}



	// • === groy »
	public static function groy(string $type, string $path = '')
	{
		self::init();
		if ($type === 'route') {
			$path = self::route('groy');
		}
		return $path;
	}



	// • === theme »
	public static function theme(string $type, string $path = '')
	{
		self::init();
		if ($type === 'route') {
			$path = self::route(strtolower(EnvX::theme()));
		}
		return $path;
	}



	// • === debug »
	public static function debug(string $type = 'route', string $path = '')
	{
		self::init();
		if ($type === 'route') {
			$path = self::route('debug');
		}
		return $path;
	}



	// • === router »
	public static function router(string $path = 'groy::web')
	{
		self::init();
		if ($path === 'groy::api') {
			return self::route('groy' . self::$DS . 'api.php');
		} elseif ($path === 'groy::app') {
			return self::route('groy' . self::$DS . 'app.php');
		} elseif ($path === 'groy::site') {
			return self::route('groy' . self::$DS . 'site.php');
		} elseif ($path === 'groy::web') {
			$path = 'groy' . self::$DS;
			return [
				// 'api' => self::route($path . 'api.php'),
				'app' => self::route($path . 'app.php'),
				'site' => self::route($path . 'site.php')
			];
		} elseif ($path === 'debug::api') {
			return self::route('debug' . self::$DS . 'api.php');
		} elseif ($path === 'debug::app') {
			return self::route('debug' . self::$DS . 'app.php');
		}
		return self::route($path);
	}



	// • === directory » utility to check & return as directory
	public static function directory(bool $check = true)
	{
		$class = static::class;

		return new class($class, $check) {
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

				if (substr($path, -1) !== self::$class::property('DS')) {
					$path .= self::$class::property('DS');
				}

				if (self::$check && !is_dir($path)) {
					DebugX::oversight('PathX', 'not a directory', $path);
				}

				return $path;
			}
		};
	}
} //> end of class ~ PathX