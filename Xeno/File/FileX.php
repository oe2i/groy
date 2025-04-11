<?php //*** FileX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\File;

use Groy\Spine\Core\DebugX;
use Groy\Xeno\Data\RandomX;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileX
{
	// • === error »
	public static function error($message, $extra = null, $label = 'FileX')
	{
		return DebugX::oversight($label, $message, $extra);
	}



	// • === inconsistency »
	public static function inconsistency($target, $actual)
	{
		return self::error('name inconsistency', ['target' => $target, 'file' => $actual]);
	}



	// • === exist »
	public static function exist($file)
	{
		if (File::exists($file)) {
			$fileIs = realpath($file);
			if ($file !== $fileIs) {
				return self::inconsistency($file, $fileIs);
			}
			return $file;
		}
		return false;
	}



	// • === is »
	public static function is($file = null)
	{
		if ($file) {
			return self::exist($file);
		}
		return new IsFileX;
	}



	// • === in »
	public static function in()
	{
		return new InFileX();
	}



	// • === name » generate filename
	public static function name($extension = null)
	{
		$name = RandomX::filename();
		if (!empty($extension)) {
			$name .= '.' . $extension;
		}
		return $name;
	}



	// • === storage »
	public static function storage($file)
	{
		return Storage::url($file);
	}
} //> end of class ~ FileX