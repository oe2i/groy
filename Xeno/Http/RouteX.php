<?php //*** RouteX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Http;

use Illuminate\Support\Facades\Route;
use Groy\Xeno\Http\RedirectX;
use Groy\Xeno\Data\StringX;
use Groy\Xeno\Auth\AuthX;

class RouteX
{
	// • === href »
	public static function href($route = null, $param = [], $absolute = false)
	{

		if (!$route) {
			$route = self::active(absolute: $absolute);
		}

		if (Route::has($route)) {
			return route($route, $param, $absolute);
		}

		if (!$absolute) {
			return StringX::begin()->ifNot($route, '/');
		}

		// NOTE: $absolute is true & route not found above!
		// TODO: prepare the url

		return $route;
	}




	// • === expired »
	public static function expired($route = 'login', $param = ['status' => 'session-expired'], $absolute = false)
	{
		return self::href($route, $param, $absolute);
	}




	// • === current »
	public static function current($type = 'route')
	{
		if ($type === 'name') {
			return Route::currentRouteName();
		} elseif ($type === 'url') {
			return url()->current();
		} else {
			$current = Route::current();
			if ($type === 'uri' && !empty($current->uri)) {
				return StringX::begin()->ifNot($current->uri, '/');
			}
			return $current;
		}
	}




	// • === active » get active route name to use
	public static function active($type = null, $absolute = false)
	{
		if ($type) {
			return self::current($type);
		}

		$route = self::current('name');

		if (!$route) {
			if (!$absolute) {
				$route = self::current('uri');
			} else {
				$route = self::current('url');
			}
		}

		return $route;
	}




	// • === isCurrent »
	public static function isCurrent($route, $type = 'route')
	{
		return $route === self::current($type);
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
		$route = self::href($route, $param, $absolute);
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
		$route = self::href($route);

		if ($action === 'goto') {
			return RouteX::redirect($route);
		}
		return $route;
	}
} //> end of class ~ RouteX