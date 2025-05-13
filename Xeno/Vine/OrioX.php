<?php //*** OrioX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Vine;

use Illuminate\Support\Collection;
use Groy\Xeno\Format\FormatX;
use Groy\Xeno\Data\String\SwapX as StrSwapX;
use Groy\Xeno\Data\String\EndX as StrEndX;
use Groy\Xeno\Data\String\BeginX as StrBeginX;
use Groy\Xeno\Data\StringX;
use Groy\Xeno\Data\CollectionX;
use Groy\Xeno\Core\DebugX;

class OrioX
{
	// ◇ === initAttr »
	public static function initAttr($attributes = null)
	{
		if (!$attributes) {
			$attributes = collect();
		}
		return $attributes;
	}





	// ◇ === setAttr »
	public static function setAttr(array|string $attribute, Collection|array &$attributes)
	{
		if (is_array($attribute)) {
			foreach ($attribute as $label => $value) {
				if (is_bool($value) && $value === true) {
					$attributes->push($label);
				} elseif ($value) {
					$attributes[] = $label . '="' . e($value) . '"';
				}
			}
		}
	}





	// ◇ === toAttr »
	public static function toAttr(&$attributes)
	{
		if (CollectionX::is($attributes)) {
			$attributes = $attributes->implode(' ');
		}
	}





	// ◇ === asset »
	public static function asset($path = null, $type = null): string|bool
	{
		if ($path === 'orio') {
			$groy = '/groy/';
			if ($type) {
				$groy .= $type . '/';
			}
			return $groy . 'orio';
		}

		$search = ['groy', '/groy', DIRECTORY_SEPARATOR . 'groy'];
		$groy = StrBeginX::withAny($path, $search, true);
		if ($groy) {
			$path = StrSwapX::first($path, $groy, '/groy');
			if ($type) {
				$path = StrSwapX::first($path, '/groy', '/groy/' . $type);
			}
			return StrSwapX::all($path, '::', '/');
		}

		return false;
	}





	// ◇ === title »
	public static function title(?string $title, ?string $secondary)
	{
		if (empty($title)) {
			return FormatX::title(ProjectX::name());
		}

		if (!empty($title)) {
			if (!empty($secondary) && !StringX::contain($title, $secondary)) {
				$title .= ' - ' . $secondary;
			}
			$title = StrEndX::ifNot($title, ' • ' . ProjectX::brand());
			return FormatX::title($title);
		}
	}

} //> end of class ~ OrioX