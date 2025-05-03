<?php //*** RequestX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Http;

use Illuminate\Http\Request;

class RequestX
{
	// • === api » is API?
	public static function api(Request $request)
	{
		return $request->is('api/*');
	}
} //> end of class ~ RequestX