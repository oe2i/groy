<?php //*** AuthX ~ ... » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Auth;

use Illuminate\Support\Facades\Auth;

class AuthX
{
	// • property
	private static bool $init = false;
	private static $auth;



	// • === init »
	private static function init()
	{
		if (!self::$init) {
			self::$auth = Auth::user();
			self::$init = true;
		}
	}



	// • === is »
	public static function is()
	{
		return Auth::check();
	}
} //> end of class ~ AuthX