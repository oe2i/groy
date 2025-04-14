<?php //*** ArrayX ~ ... » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data;

use Illuminate\Support\Arr;
use Groy\Xeno\Data\Array\MultiX;
use Groy\Xeno\Data\Array\KeyX;
use Groy\Xeno\Data\Array\ValueX;

class ArrayX
{
	// • === is »
	public static function is($array)
	{
		return is_array($array);
	}



	// • === empty - is array & empty » boolean
	public static function empty($array)
	{
		return is_array($array) && empty($array);
	}



	// • === has - is array & not empty » boolean
	public static function has($array)
	{
		return is_array($array) && !empty($array);
	}



	// • === jumble → randomize index or value »
	public static function jumble($array, $preserveKeys = true)
	{
		if (self::has($array)) {

			if (!$preserveKeys) {
				shuffle($array);
				return $array;
			}

			$keys = array_keys($array);
			shuffle($keys);

			$shuffled = [];
			foreach ($keys as $key) {
				$shuffled[$key] = $array[$key];
			}

			return $shuffled;
		}

		return $array;
	}



	// • === random → pick random index »
	public static function random($array, $pick = 1)
	{
		if (!self::is($array) || !is_numeric($pick) || $pick < 1) {
			return false;
		}

		$count = count($array);
		if ($pick >= $count) {
			return self::jumble($array, true);
		}

		$random = array_rand($array, $pick);
		$keys = is_array($random) ? $random : [$random];

		$reArray = [];
		foreach ($keys as $key) {
			$reArray[$key] = $array[$key];
		}

		return $reArray;
	}



	// • === reverse - array in reverse order »
	public static function reverse($array, $preserveKeys = true)
	{
		if (self::has($array)) {
			return array_reverse($array, $preserveKeys);
		}
		return false;
	}



	// • === flip → flip keys to values »
	public static function flip($array)
	{
		if (self::has($array)) {
			return array_flip($array);
		}
		return false;
	}



	// • === multi → $var is multi-dimensional array » boolean
	public static function multi($array = null)
	{
		if (!$array) {
			return new MultiX;
		}

		if (self::has($array)) {
			foreach ($array as $item) {
				if (is_array($item)) {
					return true;
				}
			}
		}
		return false;
	}



	// • === key »
	public static function key()
	{
		return new KeyX;
	}



	// • === value »
	public static function value()
	{
		return new ValueX;
	}



	// • === unique → prevent duplicate values »
	public static function unique($array)
	{
		if (!self::has($array)) {
			return false;
		}

		if (MultiX::is($array)) {
			foreach ($array as $index => $value) {
				if (self::is($array[$index])) {
					$array[$index] = self::unique($array[$index]);
				}
			}
		}

		return array_unique($array, SORT_REGULAR);
	}



	// • === toString → array to string »
	public static function toString($array, $flag = 'string', $separator = ' ')
	{
		if (MultiX::is($array)) {
			foreach ($array as $index => $value) {
				if (self::is($array[$index])) {
					$array[$index] = self::toString($array[$index]);
				}
			}
		}

		if (self::has($array)) {
			if (strtolower($flag) === 'uri') {
				if (empty($separator) || strtolower($separator) === 'default') {
					return http_build_query($array);
				}
				return http_build_query($array, '', $separator);
			}
			return implode($separator, $array);
		}

		return false;
	}



	// • === toJSON → array to json »
	public static function toJSON($array)
	{
		if (!self::has($array)) {
			return false;
		}
		if (MultiX::is($array)) {
			return json_encode($array, JSON_FORCE_OBJECT);
		}
		return json_encode($array);
	}



	// • === toObject → array to object »
	public static function toObject($array, $multi = true)
	{
		if (!self::has($array)) {
			return false;
		}

		if ($multi && MultiX::is($array)) {
			return json_decode(json_encode($array), false);
		}

		return (object) $array;
	}



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »


	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »


	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »



	// • === is »

} //> end of class ~ ArrayX