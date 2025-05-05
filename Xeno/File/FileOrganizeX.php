<?php //*** FileOrganizeX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\File;

use Groy\Xeno\Core\EnvX;
use Groy\Xeno\Data\Array\ValueX as ArrValueX;
use Groy\Xeno\Data\String\BeginX as StrBeginX;
use Groy\Xeno\Data\String\EndX as StrEndX;
use Groy\Xeno\Enum\Image as ImageEnumX;

class FileOrganizeX
{
	// • === theme »
	public static function theme($file)
	{
		$path = EnvX::theme();
		$paths = [$path . DIRECTORY_SEPARATOR, $path . '/'];
		return StrBeginX::ifNotAny($file, $paths);
	}




	// • === logo »
	public static function logo($logo = null)
	{
		$logo = $logo ?: EnvX::theme();
		$extension = ImageEnumX::values('lower');
		$extension = ArrValueX::prefix($extension, '.');

		$logo = StrEndX::ifNotAny($logo, $extension);

		$path = ['logo' . DIRECTORY_SEPARATOR, 'logo/'];
		$logo = StrBeginX::ifNotAny($logo, $path);

		return $logo;
	}

} //> end of class ~ FileOrganizeX