<?php //*** SiteX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Http;

use Illuminate\Support\Facades\Route;
use Groy\Xeno\Vine\BladeX;
use Groy\Xeno\Skin\ThemeX;
use Groy\Xeno\Skin\PageX;
use Groy\Xeno\Data\String\HasX as StrHasX;

class SiteX
{
	// • === view »
	public static function view($route, $view = null, $name = null)
	{
		if ($route === 'index') {
			$route = '/';
			$view = 'index';
		}

		if ($route === 'welcome') {
			if (!RouteX::valid('index')) {
				$route = '/';
			}

			if (!self::valid('welcome')) {
				$view = 'index';
			} elseif (!$view) {
				$view = 'welcome';
			}
		}


		if (!$view) {
			if (StrHasX::onlyLetter($route)) {
				$view = $route;
			}
		}

		if (!$name) {
			if ($view === 'index') {
				$name = 'index';
			} elseif (StrHasX::onlyLetter($view)) {
				$name = 'site.' . $view;
			}
		}

		return Route::view($route, PageX::site($view))->name($name);
	}




	// • === valid »
	public static function valid($view)
	{
		$blade = ThemeX::prepare('site', $view);
		return BladeX::is($blade);
	}

} //> end of class ~ SiteX