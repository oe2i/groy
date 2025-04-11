<?php //*** DebugX ~ class » Yaic™ Library for Laravel © 2024 ∞ AO™ • @osawereao • www.osawere.com ∞ Apache License ***//

namespace oYale\Anci;

class DebugX
{

	// ◈ === blade404 »
	public static function blade404($blade, $label = 'blade', $message = 'Resource Unavailable')
	{
		return self::oversight($label, $message, $blade);
	}



	// ◈ === wire404 »
	public static function wire404($file, $label = 'wire', $message = 'Component Unavailable', $wire = null)
	{
		if (!empty($wire)) {
			$file = ['Path' => $file, 'Wire' => $wire];
		}
		return self::oversight($label, $message, $file);
	}



	// ◈ === fileInconsistency »
	public static function fileInconsistency($namedFile, $actualFile)
	{
		return self::oversight('FileX', 'Name Inconsistency', ['Request' => $namedFile, 'File' => $actualFile]);
	}


}//> end of class ~ DebugX