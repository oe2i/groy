<?php //*** EnvX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Core;

use Groy\Xeno\Trait\StaticX;
use Illuminate\Support\Facades\App;

class EnvX
{
	// • trait
	use StaticX;




	// • property
	private static bool $init = false;
	private static string $env;
	private static object $firm;
	private static object $project;
	private static object $developer;




	// • === error »
	private static function error($message, $extra = null, $trace = null)
	{
		return DebugX::oversight('EnvX', $message, $extra, $trace);
	}




	// • === toArray »
	private static function toArray($line)
	{
		$result = [];
		if (!empty($line) && (strpos($line, ';') !== false)) {
			$pairs = array_filter(array_map('trim', explode(';', $line)));
			foreach ($pairs as $pair) {
				if (strpos($pair, '=') !== false) {
					list($key, $value) = explode('=', $pair, 2);
					$key = trim($key);
					$value = trim($value);
					if (isset($result[$key])) {
						if (!is_array($result[$key])) {
							$result[$key] = [$result[$key]];
						}
						$result[$key][] = $value;
					} else {
						$result[$key] = $value;
					}
				}
			}
		}
		return $result;
	}




	// • === toObject »
	private static function toObject($property)
	{
		// ... list of properties to parse
		$properties = ['FIRM', 'PROJECT', 'DEVELOPER'];

		// ... check if property and validity
		if (!in_array($property, $properties)) {
			return self::error('invalid property', $property);
		}

		// ... fetch and trim the multi-line variable
		$property = strtolower($property);
		$line = config('app.' . $property);
		if (empty($line)) {
			$line = [];
		}

		return (object) self::toArray($line);
	}




	// • === init »
	private static function init()
	{
		if (!self::$init) {
			self::$env = strtolower(App::environment());
			self::$firm = self::toObject('FIRM');
			self::$project = self::toObject('PROJECT');
			self::$developer = self::toObject('DEVELOPER');
			self::$init = true;
		}
	}




	// • === is »
	public static function is(?string $env = null)
	{
		self::init();

		if ($env === null) {
			return self::$env;
		}

		if (!empty($env) && self::$env === strtolower($env)) {
			return true;
		}

		return false;
	}




	// • === dev » is development (local) environment
	public static function dev()
	{
		return self::is('local');
	}




	// • === stage » is staging (testing) environment
	public static function stage()
	{
		return self::is('staging');
	}




	// • === prod » is production (live) environment
	public static function prod()
	{
		return self::is('production');
	}




	// • === firm »
	public static function firm($key = null)
	{
		self::init();
		return self::property('firm', $key);
	}




	// • === project »
	public static function project($key = null)
	{
		self::init();
		return self::property('project', $key);
	}




	// • === developer »
	public static function developer($key = null)
	{
		self::init();
		return self::property('developer', $key);
	}




	// • === theme »
	public static function theme()
	{
		self::init();
		$theme = self::property('project', 'theme');
		return !empty($theme) ? $theme : 'oreo';
	}




	// • === asset »
	public static function asset()
	{
		self::init();
		$asset = self::property('project', 'asset');
		return !empty($asset) ? $asset : 'theme';
	}
} //> end of class ~ EnvX