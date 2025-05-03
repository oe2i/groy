<?php //*** KeyX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\Array;

use Groy\Xeno\Data\StringX;
use Groy\Xeno\Data\ArrayX;
use Groy\Xeno\Core\VarX;

class KeyX
{
	// • === is → key in array? » boolean
	public static function is($array, $key)
	{
		return (ArrayX::has($array) && array_key_exists($key, $array));
	}



	// • === isNot → key in array? » boolean
	public static function isNot($array, $key)
	{
		return (ArrayX::has($array) && !array_key_exists($key, $array));
	}



	// • === first »
	public static function first($array)
	{
		if (ArrayX::has($array)) {
			return array_key_first($array);
		}
		return false;
	}



	// • === last »
	public static function last($array): bool|int|string
	{
		if (ArrayX::has($array)) {
			return array_key_last($array);
		}
		return false;
	}



	// • === list → array keys » boolean or array [numerically indexed]
	public static function list($array)
	{
		if (ArrayX::has($array)) {
			return array_keys($array);
		}
		return false;
	}



	// • === empty → property of array, empty? » boolean
	public static function empty($array, $key)
	{
		if (self::is($array, $key) && empty($array[$key])) {
			return true;
		}
		return false;
	}



	// • === notEmpty → property of array, not-empty? » boolean
	public static function notEmpty($array, $key)
	{
		return (self::is($array, $key) && !empty($array[$key]));
	}



	// • === reindex → re-index » array
	public static function reindex($array, $reKeys)
	{
		if (!ArrayX::has($array) || !ArrayX::is($reKeys)) {
			return false;
		}

		$reArray = [];

		foreach ($array as $key => $value) {
			if (array_key_exists($key, $reKeys)) {
				$reArray[$reKeys[$key]] = $value;
			} else {
				$reArray[$key] = $value;
			}
		}

		return $reArray;
	}



	// • === numeric → check numeric keys » boolean
	public static function numeric($array)
	{
		if (!ArrayX::has($array)) {
			return false;
		}

		foreach ($array as $key => $value) {
			if (!is_numeric($key)) {
				return false;
			}
		}

		return true;
	}



	// • === reindexNumeric → re-index numeric keys » array
	public static function reindexNumeric($array)
	{
		if (self::numeric($array) && array_key_exists(0, $array)) {
			$reArray = [];
			foreach ($array as $index => $value) {
				$reArray[$index + 1] = $value;
			}
			return $reArray;
		}

		if (ArrayX::has($array)) {
			return $array;
		}

		return false;
	}



	// • === prefix » array
	public static function prefix($array, $prefix)
	{
		if (ArrayX::has($array) && !empty($prefix)) {
			$reArray = [];
			foreach ($array as $key => $value) {
				$reArray[$prefix . $key] = $value;
			}
			return $reArray;
		}
		return $array;
	}



	// • === suffix » array
	public static function suffix($array, $suffix)
	{
		if (ArrayX::has($array) && !empty($suffix)) {
			$reArray = [];
			foreach ($array as $key => $value) {
				$reArray[$key . $suffix] = $value;
			}
			return $reArray;
		}
		return $array;
	}



	// • === swap → exchange a key in an array » array
	public static function swap($array, $key, $rekey)
	{
		if (self::is($array, $key)) {
			$array[$rekey] = $array[$key];
			unset($array[$key]);
		}
		return $array;
	}



	// • === strip » remove from array using key
	public static function strip($array, int|string|array $key)
	{
		if (!ArrayX::has($array)) {
			return false;
		}

		if (is_array($key)) {
			foreach ($key as $index => $value) {
				if (isset($array[$index])) {
					unset($array[$index]);
				}
			}
		}

		if (self::is($array, $key)) {
			unset($array[$key]);
		}

		return $array;
	}



	// • === stripEmpty »
	public static function stripEmpty($array)
	{
		if (ArrayX::has($array)) {
			foreach ($array as $key => $value) {
				if (VarX::empty($value)) {
					unset($array[$key]);
				}
			}
		}
		return $array;
	}



	// • === stripNull »
	public static function stripNull($array)
	{
		if (ArrayX::has($array)) {
			foreach ($array as $key => $value) {
				if (is_null($value)) {
					unset($array[$key]);
				}
			}
		}
		return $array;
	}



	// • === toNull »
	public static function toNull($array, $keys)
	{
		if (ArrayX::has($array)) {
			if (is_array($keys)) {
				foreach ($keys as $key) {
					if (array_key_exists($key, $array)) {
						$array[$key] = null;
					}
				}
			} elseif (array_key_exists($keys, $array)) {
				$array[$keys] = null;
			}
		}
		return $array;
	}



	// • === toUpper »
	public static function toUpper($array)
	{
		if (!ArrayX::has($array)) {
			return false;
		}

		$reArray = [];
		foreach ($array as $key => $value) {
			$index = strtoupper($key);
			$reArray[$index] = $value;
		}

		return $reArray;
	}



	// • === toLower »
	public static function toLower($array)
	{
		if (!ArrayX::has($array)) {
			return false;
		}

		$reArray = [];
		foreach ($array as $key => $value) {
			$index = strtolower($key);
			$reArray[$index] = $value;
		}

		return $reArray;
	}



	// • === useless → (isNotOrEmpty) is not a key or has empty value »
	public static function useless($array, $key)
	{
		if (self::isNot($array, $key) || self::empty($array, $key)) {
			return true;
		}
		return false;
	}



	// • === filter » get specific keys, optionally handle values (missing, empty, boolean, match).
	public static function filter(array $array, $filter, null|string|bool $remove = null): array
	{
		$reArray = [];
		$keys = ArrayX::as($filter);

		foreach ($keys as $key) {
			$reArray[$key] = array_key_exists($key, $array) ? $array[$key] : '';
		}

		if ($remove === 'empty') {
			foreach ($reArray as $key => $value) {
				if (StringX::empty($value)) {
					unset($reArray[$key]);
				}
			}
		}

		if ($remove === 'unset') {
			foreach ($reArray as $key => $value) {
				if (!array_key_exists($key, $array)) {
					unset($reArray[$key]);
				}
			}
		}

		if ($remove === 'false' || $remove === false) {
			foreach ($reArray as $key => $value) {
				if (is_bool($value) && $value === false) {
					unset($reArray[$key]);
				}
			}
		}

		if ($remove === 'true' || $remove === true) {
			foreach ($reArray as $key => $value) {
				if (is_bool($value) && $value === true) {
					unset($reArray[$key]);
				}
			}
		}

		if (!empty($remove)) {
			foreach ($reArray as $key => $value) {
				if ($value === $remove) {
					unset($reArray[$key]);
				}
			}
		}

		return $reArray;
	}



	// • === extract → extract specific keys, optionally rename, and remove those keys from original array »
	public static function extract(array &$array, $param): array
	{
		$extract = [];

		if (empty($array) || empty($param)) {
			return $extract;
		}

		if (!is_array($param)) {
			if (array_key_exists($param, $array)) {
				$extract[$param] = $array[$param];
				unset($array[$param]);
			}
		} else {
			foreach ($param as $key => $value) {
				// If numeric key, value is the actual key to extract
				if (is_numeric($key)) {
					if (array_key_exists($value, $array)) {
						$extract[$value] = $array[$value];
						unset($array[$value]);
					}
				} else {
					// Associative: rename key
					if (array_key_exists($key, $array)) {
						$extract[$value] = $array[$key];
						unset($array[$key]);
					}
				}
			}
		}

		return $extract;
	}



	// • === byValue → find key by the value in array »
	public static function byValue($array, $value, $strict = false)
	{
		return array_search($value, $array, $strict);
	}



	// • === byValues → find key by the values in array »
	public static function byValues($array, $values, $strict = false)
	{
		return array_keys($array, $values,  $strict);
	}
} //> end of class ~ KeyX