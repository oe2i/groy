<?php //*** IsFileX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\File;

use Groy\Spine\Core\PathX;

class IsFileX
{
	// • === public »
	public static function public($file)
	{
		return file_exists(PathX::public($file));
	}
} //> end of class ~ IsFileX