<?php //*** OrioX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Format;

use Illuminate\Support\Collection;

class OrioX
{
	// • === setAttr »
	public static function setAttr(array $attribute, Collection|array &$attributes)
	{
		foreach ($attribute as $label => $value) {
			if ($value) {
				$attributes[] = $label . '="' . e($value) . '"';
			}
		}
	}

} //> end of class ~ OrioX