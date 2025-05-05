<?php //*** FileX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\File;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Groy\Xeno\Core\DebugX;


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




	// • === name »
	public static function name($file)
	{
		return pathinfo($file, PATHINFO_FILENAME);
	}




	// • === basename »
	public static function basename($file)
	{
		return pathinfo($file, PATHINFO_BASENAME);
	}




	// • === extension »
	public static function extension($file)
	{
		return pathinfo($file, PATHINFO_EXTENSION);
	}




	// • === path »
	public static function path($file)
	{
		return pathinfo($file, PATHINFO_DIRNAME);
	}




	// • === storage »
	public static function storage($file)
	{
		return Storage::url($file);
	}




	// • === is »
	public static function is($file = null)
	{
		if ($file) {
			return self::exist($file);
		}

		return new FileIsX;
	}




	// • === in »
	public static function in()
	{
		return new FileInX;
	}




	// • === organize »
	public static function organize()
	{
		return new FileOrganizeX();
	}
} //> end of class ~ FileX