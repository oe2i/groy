<?php //*** KeyX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\Array;

use Groy\Xeno\Data\ArrayX;

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
} //> end of class ~ KeyX