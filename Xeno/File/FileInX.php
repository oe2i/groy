<?php //*** FileInX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\File;

use Illuminate\Support\Facades\Storage;

class FileInX
{
	// • === storage »
	public static function storage($file, $public = true)
	{
		if ($public) {
			return Storage::disk('public')->exists($file);
		}
		return Storage::exists($file);
	}




	// • === theme »
	public static function theme($file)
	{
		return FileIsX::public(FileOrganizeX::theme($file));
	}
} //> end of class ~ FileInX