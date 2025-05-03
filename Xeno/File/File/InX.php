<?php //*** InX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\File\File;

use Illuminate\Support\Facades\Storage;

class InX
{
	// • === storage »
	public static function storage($file, $public = true)
	{
		if ($public) {
			return Storage::disk('public')->exists($file);
		}
		return Storage::exists($file);
	}


} //> end of class ~ InX