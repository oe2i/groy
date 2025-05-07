<?php //*** OrioX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Vine;

use Illuminate\Support\Collection;
use Groy\Xeno\Data\String\SwapX as StrSwapX;
use Groy\Xeno\Data\String\BeginX as StrBeginX;
use Groy\Xeno\Data\StringX;
use Groy\Xeno\Core\DebugX;

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





	// • === asset »
	public static function asset($path = null): string|bool
	{
		$search = ['orio', '/orio', DIRECTORY_SEPARATOR . 'orio'];
		$orio = StrBeginX::withAny($path, $search, true);
		if ($orio) {
			$path = StrSwapX::first($path, $orio, '/orio');
			$path = StrSwapX::all($path, '::', '/');
			return $path;
		}
		return false;
	}

} //> end of class ~ OrioX