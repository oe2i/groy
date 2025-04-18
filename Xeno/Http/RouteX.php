<?php //*** RouteX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Http;

use Illuminate\Support\Facades\Route;
use Groy\Xeno\Http\RedirectX;
use Groy\Xeno\Auth\AuthX;

class RouteX
{
	public static function format($route = null, $param = [], $absolute = false)
	{
		if (empty($route)) {
			$route = Route::currentRouteName();
			if (empty($route)) {
				$route = request()->getRequestUri();
			}
		}

		if (Route::has($route)) {
			return route($route, $param, $absolute);
		}

		if (!$absolute) {
			return StringX::begin()->ifNot($route, '/');
		}

		return $route;
	}



	// • === expired »
	public static function expired($route = 'login', $param = ['status' => 'session-expired'], $absolute = false)
	{
		return self::format($route, $param, $absolute);
	}



	// • === current »
	public static function current($type = 'route')
	{
		if ($type === 'name') {
			return Route::currentRouteName();
		} elseif ($type === 'url') {
			return url()->current();
		} else {
			return Route::current();
		}
	}



	// • === isCurrent »
	public static function isCurrent($route, $type = 'route')
	{
		if ($route === self::current($type)) {
			return true;
		}
		return false;
	}



	// • === redirect »
	public static function redirect($to)
	{
		// TODO: redirect if route is not active or delayed
		return RedirectX::link($to);
	}



	// • === goto
	public static function goto($route = null, $param = [], $absolute = false, $type = 'route')
	{
		$route = self::format($route, $param, $absolute);
		if (!self::isCurrent($route, $type)) {
			return self::redirect($route);
		}
	}



	// • === restrict »
	public static function restrict($route = 'login', $type = 'route', $param = [], $absolute = false)
	{
		if (!AuthX::is()) {
			return self::goto($route, $param, $absolute, $type);
		}
	}



	// • === ifAuthElse »
	public static function ifAuthElse($success, $failure, $action = 'goto')
	{
		$route = AuthX::is() ? $success : $failure;
		$route = (isset($route) && $route !== '' && $route !== false) ? $route : $success;
		$route = self::format($route);

		if ($action === 'goto') {
			return RouteX::redirect($route);
		}
		return $route;
	}
} //> end of class ~ RouteX