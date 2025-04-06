<?php //*** ObjectX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data;

use Groy\Spine\CanX;

class ObjectX
{
	// • === is »
	public static function is($object)
	{
		return is_object($object);
	}



	// • === can » boolean
	public static function can($object) {}



	// • === empty → is object & empty » boolean
	public static function empty(&$var)
	{
		return is_object($var) && empty(get_object_vars($var));
	}



	// • === append » boolean
	public static function append(&$object, $param)
	{
		if (CanX::iterate($param)) {
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
	public static function toArray($object){
		return (array) $object;
	}
} //> end of class ~ ObjectX
