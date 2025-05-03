<?php //*** PageX ~ class. » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Skin;

use Groy\Xeno\Http\RouteX;
use Groy\Xeno\Data\StringX;
use Groy\Xeno\Vine\BladeX;

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




	// • === norm »
	public static function norm($page, $check = true)
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
		if (StringX::has()->onlyLetter($title)) {
			return $title;
		}
		$title = StringX::afterLastAs($title, '.');
		return $title;
	}
} //> end of class ~ PageX;