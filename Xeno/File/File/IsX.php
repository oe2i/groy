<?php //*** IsX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\File\File;

use Groy\Spine\Core\PathX;

class IsX
{
	// • === public »
	public static function public($file)
	{
		return is_file(PathX::public($file));
	}

} //> end of class ~ IsX