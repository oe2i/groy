<?php //*** VarX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Core;

use Illuminate\Support\Collection;
use Groy\Xeno\Data\StringX;

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




	// • === bool »
	public static function bool(&$var)
	{
		return is_bool($var);
	}




	// • === true »
	public static function true(&$var)
	{
		return ($var === true);
	}




	// • === false »
	public static function false(&$var)
	{
		return ($var === false);
	}




	// • === null »
	public static function null(&$var)
	{
		return is_null($var);
	}




	// • === instance »
	public static function instance($var, $instanceOf)
	{
		return $var instanceof $instanceOf;
	}




	// • === type » $var type or comparison
	public static function type(&$var, $type = null)
	{
		if (is_null($type)) {
			return gettype($var);
		}
		if (!empty($type) && strtolower(gettype($var)) === strtolower($type)) {
			return true;
		}
		return false;
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
		if (is_null($var)) {
			return true;
		}

		if (StringX::is($var)) {
			if (strlen($var) === 0) {
				return true;
			}
			return false;
		}

		if (is_array($var) || is_object($var)) {
			if (empty($var)) {
				return true;
			}
			return false;
		}

		if ($var instanceof Collection) {
			return $var->isEmpty();
		}

		//TODO: Implement more types of empty check!

		return false;
	}




	// • === notEmpty »
	public static function notEmpty($var)
	{
		return (!is_bool($var) && !empty($var));
	}




	// • === numeric »
	public static function numeric($var)
	{
		return is_numeric($var);
	}




	// • === iterable » boolean
	public static function iterable(&$var)
	{
		return is_iterable($var);
	}




	// • === stringable » boolean
	public static function stringable(&$var)
	{
		if (!blank($var)) {

			// ~ is scalar [string, integer, float, or boolean]
			if (is_scalar($var)) {
				return true;
			}

			// ~ is an object that implements __toString
			if (is_object($var) && method_exists($var, '__toString')) {
				return true;
			}
		}

		return false;
	}




	// • === safe »
	public static function safe($var, $default = '')
	{
		return isset($var) ? $var : $default;
	}




	// • === email »
	public static function email($var)
	{
		return filter_var($var, FILTER_VALIDATE_EMAIL) !== false;
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

		// REVIEW: Move code-block to CompareX
		// TODO: Implement more comparison
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




	// • === html » has HTML?
	public static function html($var)
	{
		return $var !== strip_tags($var);
	}
} //> end of class ~ VarX