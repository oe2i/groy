<?php //*** VarX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Spine\Core;

use Groy\Xeno\Data\StringX;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class VarX
{
	// • === is »
	public static function is($var, $comparison = null, $strict = false)
	{
		if (is_null($var)) {
			return false;
		}

		if (is_null($comparison)) {
			return $var === 0 || !empty($var) || is_bool($var);
		}

		return $strict ? $var === $comparison : $var == $comparison;
	}



	// • === type »
	public static function type($var)
	{
		if (self::is($var)) {
			return gettype($var);
		}
		return null;
	}



	// • === compare »
	public static function compare($var, $comparison, $strict = false)
	{
		if (is_null($var) && is_null($comparison)) {
			return true;
		}

		if (is_string($var) && is_string($comparison)) {
			if ($strict) {
				return $var !== $comparison;
			}
			return $var != $comparison;
		}

		return false;
	}



	// • === empty » if a set variable is empty
	public static function empty($var)
	{
		if (self::is($var)) {
			if (is_string($var) && strlen($var) < 1) {
				return true;
			}

			if (is_array($var) || is_object($var) && (empty($var))) {
				return true;
			}

			if ($var instanceof Collection) {
				return $var->isEmpty();
			}
		}
		return false;
	}



	// • === safe »
	public static function safe($var, $default = '')
	{
		return isset($var) ? $var : $default;
	}



	// • === setIf »
	public static function setIf(mixed &$var, mixed $as, ?string $type = null)
	{
		if ($type && self::type($var) === $type) {
			$var = $as;
			return true;
		}

		if (!$type) {
			$var = $as;
			return true;
		}

		return false;
	}



	// • === setIfSame »
	public static function setIfSame(mixed &$var, mixed $as, mixed $comparison = null, bool $strict = false)
	{
		if (self::compare($var, $comparison, $strict)) {
			$var = $as;
			return true;
		}
		return false;
	}



	// • === setIfNot » set variable if it is null OR
	public static function setIfNot(mixed &$var, mixed $as, mixed $comparison = null, bool $strict = false): bool
	{
		if (is_null($var)) {
			$var = $as;
			return true;
		}

		// TODO: move this block to CompareX - for other comparison
		if (is_string($var) && !is_null($comparison)) {
			if ($strict ? $var !== $comparison : $var != $comparison) {
				$var = $as;
				return true;
			}
		}

		return false;
	}



	// • === setIfBool »
	public static function setIfBool(mixed &$var, mixed $as)
	{
		return self::setIf($var, $as, 'boolean');
	}



	// • === setIfInt »
	public static function setIfInt(mixed &$var, mixed $as)
	{
		return self::setIf($var, $as, 'integer');
	}



	// • === setIfFloat »
	public static function setIfFloat(mixed &$var, mixed $as)
	{
		return self::setIf($var, $as, 'double');
	}



	// • === setIfString »
	public static function setIfString(mixed &$var, mixed $as)
	{
		return self::setIf($var, $as, 'string');
	}



	// • === setIfArray »
	public static function setIfArray(mixed &$var, mixed $as)
	{
		return self::setIf($var, $as, 'array');
	}


	// • === setIfObject »
	public static function setIfObject(mixed &$var, mixed $as)
	{
		return self::setIf($var, $as, 'object');
	}



	// • === isString »
	public static function isString($string)
	{
		return StringX::is($string);
	}



	// • === isArray »
	public static function isArray($array)
	{
		return is_array($array);
	}



	// • === isObject »
	public static function isObject($object)
	{
		return is_object($object);
	}



	// • === isCollection »
	public static function isCollection($collection)
	{
		return $collection instanceof Collection;
	}


	public static function isModel($var)
	{
		return $var instanceof Model;
	}
} //> end of class ~ VarX