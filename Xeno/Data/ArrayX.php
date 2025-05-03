<?php //*** ArrayX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data;

use Groy\Xeno\Data\Array\MultiX;
use Groy\Xeno\Data\Array\KeyX;
use Groy\Xeno\Data\Array\ValueX;
use Groy\Xeno\Data\Array\BlendX;

class ArrayX
{
	// • ===  is »
	public static function is($array)
	{
		return is_array($array);
	}




	// • ===  empty - is array & empty » boolean
	public static function empty($array)
	{
		return is_array($array) && empty($array);
	}




	// • ===  has - is array & not empty » boolean
	public static function has($array)
	{
		return is_array($array) && !empty($array);
	}




	// • ===  jumble → randomize index or value »
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




	// • ===  random → pick random index »
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




	// • ===  reverse - array in reverse order »
	public static function reverse($array, $preserveKeys = true)
	{
		if (self::has($array)) {
			return array_reverse($array, $preserveKeys);
		}
		return false;
	}




	// • ===  flip → flip keys to values »
	public static function flip($array)
	{
		if (self::has($array)) {
			return array_flip($array);
		}
		return false;
	}




	// • ===  unique → prevent duplicate values »
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




	// • ===  as » convert and return as array
	public static function as($var)
	{
		if (self::is($var)) {
			return $var;
		}

		if (StringX::is($var)) {
			return self::fromString($var);
		}

		if (ObjectX::is($var)) {
			return ObjectX::toArray($var);
		}
	}




	// • ===  toString → array to string »
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




	// • ===  toJSON → array to json »
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




	// • ===  toObject → array to object »
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




	// • ===  stripEmpty »
	public static function stripEmpty($array)
	{
		return KeyX::stripEmpty($array);
	}




	// • ===  stripNull »
	public static function stripNull($array)
	{
		return KeyX::stripNull($array);
	}




	// • ===  hasKeyValue »
	public static function hasKeyValue($array, $key, $value, bool $strict = true): bool
	{
		if (!self::has($array)) {
			return false;
		}

		$compare = function ($a, $b) use ($strict) {
			return $strict ? $a === $b : $a == $b;
		};

		if (MultiX::keyNumeric($array)) {
			$array = array_filter($array, function ($row) use ($key, $value, $compare) {
				return is_array($row) && array_key_exists($key, $row) && $compare($row[$key], $value);
			});
			return !empty($array);
		}

		return array_key_exists($key, $array) && $compare($array[$key], $value);
	}




	// • ===  fromString » convert string to array
	public static function fromString($string, $delimiter = null, $case = false)
	{
		if (!StringX::is($string)) {
			return false;
		}

		if (!$delimiter) {
			$delimiter = match (true) {
				StringX::contain($string, ',', $case) => ',',
				StringX::contain($string, '|', $case) => '|',
				StringX::contain($string, ';', $case) => ';',
				StringX::contain($string, 'space', $case) => 'space',
				default => null,
			};
		}
		if ($delimiter) {
			return StringX::toArray($string, $delimiter, $case);
		}

		return false;
	}




	// • ===  joinString » merge/append string to array
	public static function joinString($array, $string, $delimiter = null, $case = false)
	{
		if (!self::is($array) || !StringX::is($string)) {
			return false;
		}

		$stringArray = self::fromString($string, $delimiter, $case);
		if (is_array($stringArray)) {
			return array_merge($array, $stringArray);
		}

		array_push($array, $string);
		return $array;
	}




	// • ===  extend » merge/append $argument [$array|$key, $value] to array
	public static function extend($array, ...$argument)
	{
		if (!self::is($array)) {
			return false;
		}

		$count = count($argument);

		if ($count === 1) {
			$entry = $argument[0];

			if (StringX::is($entry)) {
				return self::joinString($array, $entry);
			}

			array_push($array, $entry);
			return $array;
		}

		if ($count === 2) {
			$key = $argument[0];
			$value = $argument[1];

			if (StringX::is($key)) {
				$array = array_merge($array, [$key => $value]);
			}
		}

		return $array;
	}




	// • ===  key »
	public static function key()
	{
		return new KeyX;
	}




	// • ===  value »
	public static function value()
	{
		return new ValueX;
	}




	// • ===  multi → $var is multi-dimensional array » boolean
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



	public static function blend($array, $blend)
	{
		return BlendX::handle($array, $blend);
	}




	// • ===  increment → count & increment » array
	public static function increment($array, string $prefix = '', string $suffix = '', $behavior = 'append')
	{
		if (!self::has($array)) {
			return false;
		}
		$count = count($array);
		$increment = $count + 1;

		$string = $prefix . $increment . $suffix;

		if ($behavior === 'prepend') {
			array_unshift($array, $string);
		} else {
			$array[] = $string;
		}

		return $array;
	}




	// • ===  decrement → count & remove last element from array » array
	public static function decrement($array)
	{
		if (!self::has($array)) {
			return false;
		}
		$count = count($array);
		if ($count > 0) {
			array_pop($array);
		}
		return $array;
	}
} //> end of class ~ ArrayX