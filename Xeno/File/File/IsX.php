<?php //*** IsX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\File\File;

use Groy\Xeno\Core\PathX;
use Illuminate\Support\Facades\View;

class IsX
{
	// • === public »
	public static function public($file)
	{
		return is_file(PathX::public($file));
	}




	// • === blade »
	public static function blade($blade)
	{
		return View::exists($blade);
	}

} //> end of class ~ IsX