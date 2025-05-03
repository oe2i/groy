<?php //*** App ~ organizr » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Orig\Organizr;

use App\Http\Controllers\Controller;
use Groy\Xeno\Auth\AuthX;
use Groy\Xeno\Http\RouteX;


class App extends Controller
{
	// • === index »
	public static function index()
	{
		return RouteX::ifAuthElse('dashboard', 'login');
	}
} //> end of class ~ App
