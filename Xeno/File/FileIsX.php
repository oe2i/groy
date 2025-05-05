<?php //*** FileIsX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\File;

use Illuminate\Support\Facades\View;
use Groy\Xeno\Core\PathX;
use Groy\Xeno\Core\EnvX;
use Groy\Xeno\Enum\Image as ImageEnumX;
use Groy\Xeno\Data\Array\ValueX as ArrValueX;
use Groy\Xeno\Data\String\EndX as StrEndX;
use Groy\Xeno\Data\String\BeginX as StrBeginX;

class FileIsX
{
	// • === invoke »
	public function __invoke($file)
	{
		return FileX::exist($file);
	}




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




	// • === logo »
	public static function logo($logo = null, $return = false)
	{
		$logo = FileOrganizeX::logo($logo);
		$check = FileIsX::public($logo);

		if ($return && $check) {
			return $logo;
		}

		return $check;
	}

} //> end of class ~ FileIsX