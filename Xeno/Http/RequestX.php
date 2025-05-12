<?php //*** RequestX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Http;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Groy\Xeno\Vine\BladeX;
use Groy\Xeno\Skin\ThemeX;
use Groy\Xeno\Skin\PageX;
use Groy\Xeno\Data\String\SwapX as StrSwapX;
use Groy\Xeno\Data\String\StripX as StrStripX;
use Groy\Xeno\Data\String\SpaceX as StrSpaceX;
use Groy\Xeno\Data\String\HasX as StrHasX;
use Groy\Xeno\Data\String\CropX as StrCropX;
use Groy\Xeno\Data\String\CaseX as StrCaseX;
use Groy\Xeno\Data\String\BeginX as StrBeginX;
use Groy\Xeno\Data\StringX;
use Groy\Xeno\Core\DebugX;

class RequestX
{
	// ◇ === view »
	public static function view($uri, $view = null, $name = null, $path = 'site')
	{
		self::withView($uri, $view, $name, $path);
		return Route::view($uri, $view)->name($name);
	}





	// ◇ === site »
	public static function site($uri, $view = null, $name = null)
	{
		return self::view($uri, $view, $name, 'site');
	}





	// ◇ === page »
	public static function page($uri, $view = null, $name = null)
	{
		return self::view($uri, $view, $name, 'page');
	}





	// ◇ === api »
	public static function api($uri, $controller, $action = 'index', $name = null)
	{
		// TODO: return json response
	}





	// ◇ === isApi »
	public static function isApi(?Request $request = null)
	{
		if ($request) {
			$request = request();
		}

		return $request->is('api/*') || StrBeginX::with($request->getHost(), 'api.');
	}





	// ◇ === isBlade »
	private static function isBlade($view, $path = null)
	{
		if (StringX::valid($view)) {
			if ($path) {
				$view = ThemeX::prepare($path, $view);
			}
			return BladeX::is($view);
		}

		return false;
	}





	// ◇ === withView »
	private static function withView(&$uri, &$view = null, &$name = null, $path = 'site')
	{
		$home = ['index', 'home', 'welcome'];
		if (StringX::isAny($uri, array_merge(['/'], $home))) {
			$uri = '/';
			$name = 'home';

			if (!$view) {
				foreach ($home as $blade) {
					if (self::isBlade($blade, $path)) {
						$view = $blade;
						break;
					}
				}
			}

			$view = !empty($view) ? $view : 'landing';
		}

		if (!$view) {
			if (StrHasX::onlyLetter($uri)) {
				$view = $uri;
			} else {
				$view = StrCropX::begin($uri, '/');
				// TODO: Improve code with additional formatting
			}
		}

		if (!$name) {
			if (StrHasX::onlyLetter($view)) {
				if ($path === 'site') {
					$name = 'site.' . $view;
				} else {
					$name = $view;
				}
			}
		}


		if ($path === 'site') {
			$view = PageX::site($view);
		}

		if ($path === 'page') {
			$view = PageX::view($view);
		}
	}





	// ◇ === withController »
	private static function withController(&$uri, &$controller = null, &$action = null, &$name = null)
	{
		if (!$controller) {
			$handle = $uri;
			$handle = StrCropX::begin($handle, '/');

			if (StringX::contain($handle, '/')) {
				$controller = StringX::before($handle, '/');
			}

			if ($controller) {
				$handle = StringX::afterFirst($handle, '/' . $action);
			}


			if (!$controller) {
				if (StringX::contain($handle, '-')) {
					$controller = StringX::before($handle, '-');
				}

				if ($controller) {
					$handle = StringX::afterFirst($handle, '-' . $action);
				} else {
					$controller = $handle;
				}
			}
		}

		if (!$action && $controller && $handle && ($controller !== $handle)) {
			$action = $handle;
		}

		if (StringX::contain($action, '-')) {
			$action = StrSwapX::withSpace($action, '-');
		}
		$action = StrCaseX::camel($action);
		$action = !empty($action) ? $action : 'index';

		if (!$name) {
			if ($controller) {
				$name = $controller;
			}

			if ($name && $action) {
				$append = $action;
				if (StrCaseX::hasMixed($append)) {
					$append = StrSpaceX::chain($append)
						->bind('upper')
						->bind('toLower')
						->bind('toDot')
						->fluent();
				}
				$name .= '.' . $append;
			}
		}
	}

} //> end of class ~ RequestX