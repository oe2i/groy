<?php  // *** ProjectX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Vine;

use Groy\Xeno\Skin\PageX;
use Groy\Xeno\Data\StringX;
use Groy\Xeno\Core\EnvX;

class ProjectX
{
	// • === name »
	public static function name()
	{
		return EnvX::project('name');
	}




	// • === alias »
	public static function alias()
	{
		return EnvX::project('alias');
	}




	// • === brand »
	public static function brand()
	{
		return EnvX::project('brand');
	}




	// • === email »
	public static function email()
	{
		return EnvX::project('email');
	}




	// • === summary »
	public static function summary()
	{
		return EnvX::project('summary');
	}





	// • === developer »
	public static function developer($key = 'firm')
	{
		return EnvX::developer($key);
	}




	// • === author »
	public static function author($key = null)
	{
		if ($key === 'url') {
			return EnvX::developer('authorurl');
		}
		return EnvX::developer('author');
	}





	// • === title »
	public static function title($page = null)
	{
		if (!$page) {
			$page = PageX::current();
		}
		$title = self::name();
		if ($page && $page !== 'index') {
			$title = $page . ' - ' . $title;
		}
		$title .= ' • ' . self::brand();
		$title = StringX::swap()->hyphen($title, ' ');
		return ucwords($title);
	}
}  // > end of class ~ ProjectX
