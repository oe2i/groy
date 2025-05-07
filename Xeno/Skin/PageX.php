<?php //*** PageX ~ class. » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Skin;

use Groy\Xeno\Vine\BladeX;
use Groy\Xeno\Http\RouteX;
use Groy\Xeno\Data\StringX;
use Groy\Xeno\Data\String\HasX as StrHasX;

class PageX
{
	// • === resolve »
	private static function resolve($page, $check)
	{
		if ($check) {
			return BladeX::safe($page);
		}
		return $page;
	}




	// • === prepare »
	protected static function prepare($page, $check)
	{
		return self::resolve(ThemeX::prepare('page', $page), $check);
	}




	// • === name »
	public static function name($page, $check = false)
	{
		return self::prepare($page, $check);
	}




	// • === view »
	public static function view($page, $check = true)
	{
		return self::prepare($page, $check);
	}




	// • === site »
	public static function site($page, $check = true)
	{
		return self::resolve(ThemeX::prepare('site', $page), $check);
	}




	// • === guide »
	public static function guide($page, $check = true)
	{
		// ➝ auth
		if (in_array($page, ['login', 'register'])) {
			$page = 'auth.' . $page;
		}

		return self::prepare($page, $check);
	}




	// • === current »
	public static function current()
	{
		// TODO: improve this
		$title = RouteX::current('name');
		if (StrHasX::onlyLetter($title)) {
			return $title;
		}
		$title = StringX::afterLastAs($title, '.');
		return $title;
	}




	// • === render »
	public static function render($view, array $data = [], array $merge = [])
	{
		$view = self::guide($view);
		return view($view, $data, $merge);
	}

} //> end of class ~ PageX;