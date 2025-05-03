<?php //*** ObjectX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data;

use Groy\Xeno\Core\VarX;

class ObjectX
{
	// • === is »
	public static function is($object)
	{
		return is_object($object);
	}




	// • === can » boolean
	public static function can($object)
	{
	}




	// • === empty → is object & empty » boolean
	public static function empty(&$var)
	{
		return is_object($var) && empty(get_object_vars($var));
	}




	// • === has » boolean
	public static function has($object, $property, $checkEmptyProperty = false): bool
	{
		if (self::empty($object) || !isset($object->$property)) {
			return false;
		}
		if ($checkEmptyProperty && empty($object->$property)) {
			return false;
		}
		return true;
	}




	// • === var » set default value if not set
	public static function var($object, $property, $checkEmptyProperty = false, $default = null)
	{
		$has = self::has($object, $property, $checkEmptyProperty);
		if ($has) {
			return $has;
		}
		return $default;
	}




	// • === append » append & return booleans
	public static function append(&$object, $param)
	{
		if (VarX::iterable($param)) {
			if (empty($object)) {
				$object = new \stdClass();
			} elseif (!is_object($object)) {
				return false;
			}
			foreach ($param as $key => $value) {
				$object->{$key} = $value;
			}
			return true;
		}
		return false;
	}




	// • === toArray »
	public static function toArray($object)
	{
		return (array) $object;
	}
} //> end of class ~ ObjectX
