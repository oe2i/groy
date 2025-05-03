<?php //*** ValueX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\Array;

use Groy\Xeno\Data\ArrayX;

class ValueX
{
	// • === is → is array and value in? » boolean
	public static function is($array, $value)
	{
		return (ArrayX::has($array) && in_array($value, $array));
	}




	// • === isNot → is array but $value not in? » boolean
	public static function isNot($array, $value)
	{
		return (ArrayX::has($array) && !in_array($value, $array));
	}



	// • === first »
	public static function first($array)
	{
		if (ArrayX::has($array)) {
			return reset($array);
		}
		return false;
	}



	// • === last »
	public static function last($array)
	{
		if (ArrayX::has($array)) {
			return end($array);
		}
		return false;
	}



	// • === list → array values » boolean, numerically indexed
	public static function list($array)
	{
		if (ArrayX::has($array)) {
			return array_values($array);
		}
		return false;
	}



	// • === unique → prevent duplicate »
	public static function unique($array)
	{
		return ArrayX::unique($array);
	}



	// • === toString → prevent duplicate »
	public static function toString($array, $flag = 'string', $separator = ' ')
	{
		return ArrayX::toString($array, $flag, $separator);
	}



	// • === strip → remove from array [by value] »
	public static function strip($array, $filter)
	{
		if (!ArrayX::has($array)) {
			return false;
		}

		if (!is_array($filter)) {
			if (($key = array_search($filter, $array)) !== false) {
				unset($array[$key]);
			}
		} else {
			foreach ($filter as $index => $value) {
				if (($key = array_search($value, $array)) !== false) {
					unset($array[$key]);
				}
			}
		}
		return $array;
	}



	// • === append → add value to array »
	public static function append($array, $value)
	{
		if (!ArrayX::is($array)) {
			return false;
		}
		array_push($array, $value);
		return $array;
	}



	// • === exclude » exclude specific values from array
	public static function exclude($array, $exclude, $reindex = false)
	{
		if (!empty($exclude)) {
			$exclude = is_array($exclude) ? $exclude : [$exclude];
			$array = array_diff($array, $exclude);
			if ($reindex === true) {
				return array_values($array);
			}
		}

		return $array;
	}
} //> end of class ~ ValueX