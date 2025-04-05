<?php //*** App ~ organizr » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Orig\Organizr;

use App\Http\Controllers\Controller;
use Groy\Xeno\Auth\AuthX;
use Groy\Xeno\Http\RouteX;


class App extends Controller
{
	// • === index »
	public static function index()
	{
		$landing = 'dashboard';
		// $route = RouteX::format('login');
		if (AuthX::is()) {
			// 	$route = RouteX::format($landing);
		}

		$route = (isset($route) && $route !== '' && $route !== false) ? $route : $landing;
		// TODO: redirect if route is not active
		return redirect($route);
	}
} //> end of class ~ App
