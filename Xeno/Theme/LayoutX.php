<?php //*** LayoutX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Theme;

use Groy\Xeno\Theme\PageX;

class LayoutX
{
	// • === as »
	public static function as($file)
	{
		return ThemeX::as('layout', $file);
	}



	// • === bit »
	public static function bit($file)
	{
		return self::as('bit.' . $file);
	}



	// • === region »
	public static function region($file)
	{
		return self::as('region.' . $file);
	}


	// • === slice »
	public static function slice($file)
	{
		return self::as('slice.' . $file);
	}


	// • === piece »
	public static function piece($file)
	{
		return self::as('piece.' . $file);
	}



	// • === nav »
	public static function nav($file = null)
	{
		if ($file) {
			return self::piece('nav.' . $file);
		}

		return new class extends LayoutX {

			// ➝ primary
			public function primary($file = null)
			{
				$file = $file ? "primary.$file" : 'primary';
				return self::nav($file);
			}


			// ➝ secondary
			public function secondary($file = null)
			{
				$file = $file ? "secondary.$file" : 'secondary';
				return self::nav($file);
			}


			// ➝ topbar
			public function topbar($file = null)
			{
				$file = $file ? "topbar.$file" : 'topbar';
				return self::nav($file);
			}


			// ➝ sidebar
			public function sidebar($file = null)
			{
				$file = $file ? "sidebar.$file" : 'sidebar';
				return self::nav($file);
			}


			// ➝ header
			public function header($file = null)
			{
				$file = $file ? "header.$file" : 'header';
				return self::nav($file);
			}


			// ➝ footer
			public function footer($file = null)
			{
				$file = $file ? "footer.$file" : 'footer';
				return self::nav($file);
			}


			// ➝ bottom
			public function bottom($file = null)
			{
				$file = $file ? "bottom.$file" : 'bottom';
				return self::nav($file);
			}
		};
	}



	// • === silo »
	public static function silo($file)
	{
		return self::piece('silo.' . $file);
	}



	// • === collop »
	public static function collop($file, $module = null)
	{
		if (!empty($module)) {
			$file = $module . '.' . $file;
		}
		return self::as('collop.' . $file);
	}



	// • === form »
	public static function form($file)
	{
		return self::collop('form.' . $file);
	}



	// • === page »
	public static function page($file)
	{
		return PageX::as($file);
	}



	// • === slab »
	public static function slab($file, $component = null, $path = 'collop')
	{
		$file = 'slab.' . $file;
		if (!empty($component)) {
			$file = $component . '.' . $file;
		}
		if (!empty($path)) {
			$paths = ['page', 'collop'];
			if (in_array($path, $paths)) {
				$file = self::{$path}($file);
			}
		}
		return $file;
	}
} //> end of class ~ LayoutX