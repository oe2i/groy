<?php //*** VarX ~ class » Yale™ Library - Yet Another Laravel Elevator © 2024 ∞ AO™ • @osawereao • www.osawere.com ∞ Apache License ***//

namespace Yale\Anci;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class VarX
{
	// ◈ === is » boolean
	public static function is(&$var = null, $comparison = null, $strick = false)
	{
		if (is_null($var)) {
			return false;
		}
		if (is_null($comparison)) {
			if ($var === 0) {
				return true;
			}
			if (!empty($var)) {
				return true;
			}
		}
		// TODO: implement code for comparison & strick check
		return false;
	}



	// ◈ === safe »
	public static function safe(&$var = null, $default = '')
	{
		return isset($var) ? $var : $default;
	}















	// • ==== setIfNot → ... » boolean
	public static function setIfNot(&$var, $value)
	{
		if (!self::is($var)) {
			$var = $value;
			return true;
		}
		return false;
	}



	// • ==== setIf → ... » boolean | value
	public static function setIf($var, &$check, $value = null)
	{
		if (self::is($check)) {
			if (is_null($value)) {
				$var = $check;
			} else {
				$var = $value;
			}
			return $var;
		}
		return null;
	}




















	// • ==== isObject → ... » boolean
	public static function isObject($var)
	{
		if (is_object($var)) {
			return true;
		}
		return false;
	}





	// • ==== isLaravelModel → ... » boolean
	public static function isModel($var)
	{
		if (self::isObject($var) && $var instanceof Model) {
			return true;
		}
		return false;
	}




	// • ==== isCollection → ... » boolean
	public static function isCollection($var)
	{
		if ($var instanceof Collection) {
			return true;
		}
		return false;
	}





	// • ==== isStringable → ... » boolean
	public static function isStringable($var)
	{
		if (is_string($var)) {
			return true;
		}
		return false;
	}







	// • ==== isEmpty → ... » boolean
	public static function isEmpty(&$var)
	{
		// if (self::isLaravelModel($var) && property_exists($var, 'exists') && !$var->exists) {
		// 	return true;
		// }
		// return false;
		if (!isset($var)) {
			return true;
		}

		if (self::isObject($var) && empty($var)) {
			return true;
		}

		if (is_array($var) && empty($var)) {
			return true;
		}

		if (self::isCollection($var) && $var->isEmpty()) {
			return true;
		}

		if (is_string($var) && $var == '') {
			return true;
		}

		return false;
	}



	// • ==== arrayObject • ... »
	public static function appendObject(&$var, $data)
	{
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$var->${$key} = $value;
			}
		}
	}

}//> end of class ~ VarX