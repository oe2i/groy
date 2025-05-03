<?php //*** CollectionX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data;

use Illuminate\Support\Collection;
use Groy\Xeno\Data\Array\MultiX;

class CollectionX
{
	// • ===  is »
	public static function is($collection)
	{
		return ($collection instanceof Collection);
	}




	// • ===  has »
	public static function has($collection)
	{
		if ($collection instanceof Collection) {
			return $collection->isNotEmpty();
		}
		return false;
	}




	// • ===  empty »
	public static function empty($collection)
	{
		return ($collection instanceof Collection) && $collection->isEmpty();
	}




	// • ===  create »
	public static function create($items)
	{
		$collection = Collection::make($items);
		if (self::is($collection)) {
			return $collection;
		}
		return false;
	}




	// • ===  toArray »
	public static function toArray($collection)
	{
		if (self::has($collection)) {
			$data = $collection->toArray();
			if (MultiX::one($data)) {
				return $data[0];
			}
			return $data;
		}
		return [];
	}
} //> end of class ~ CollectionX