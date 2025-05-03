<?php //*** RouteX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Http;

use Illuminate\Support\Facades\Route;
use Groy\Xeno\Http\RedirectX;
use Groy\Xeno\Data\StringX;
use Groy\Xeno\Auth\AuthX;

class RouteX
{
	// • === hrefActive » get active route [name/uri/url] to use
	public static function hrefActive($type = null, $absolute = false)
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




	// • === href »
	public static function href($route = null, $param = [], $absolute = false)
	{

		if (!$route) {
			$route = self::hrefActive(absolute: $absolute);
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




	// • === valid »
	public static function valid($route)
	{
		return Route::has($route);
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




	// • === ifAuth → ... »
	public static function ifAuth($success, $action = 'goto')
	{
		$auth = AuthX::is();
		if ($auth) {
			if ($action === 'goto') {
				return RouteX::redirect($success);
			}
		}
		return $auth;
	}
} //> end of class ~ RouteX