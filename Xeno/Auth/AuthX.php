<?php //*** AuthX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Auth;

use Illuminate\Support\Facades\Auth;

class AuthX
{
	// • property
	private static bool $init = false;
	private static $user;



	// • === init »
	private static function init()
	{
		if (!self::$init) {
			self::$user = Auth::user();
			self::$init = true;
		}
	}



	// • === is »
	public static function is()
	{
		return Auth::check();
	}



	// • === sure »
	public static function sure()
	{
		self::init();
		if (self::is() && !empty(self::$user) && is_object(self::$user)) {
			return true;
		}
		return false;
	}



	// ◈ === name »
	public static function name()
	{
		$name = 'anonymous';
		if (self::sure() && ObjectX::has($user, 'name')) {
			$name = self::$user->name;
		}
		return ucwords($name);
	}
} //> end of class ~ AuthX