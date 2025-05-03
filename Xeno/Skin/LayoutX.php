<?php //*** LayoutX ~ class. » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Skin;

use Groy\Xeno\Vine\BladeX;
use Groy\Xeno\Http\RouteX;
use Groy\Xeno\Data\StringX;

class LayoutX
{
	// • === resolve »
	private static function resolve($file, $check)
	{
		if ($check) {
			return BladeX::safe($file);
		}
		return $file;
	}




	// • === prepare »
	protected static function prepare($file, $check)
	{
		return self::resolve(ThemeX::prepare('layout', $file), $check);
	}




	// • === name »
	public static function name($page, $check = false)
	{
		return self::prepare($page, $check);
	}




	// • === view »
	public static function view($file, $check = true)
	{
		return self::prepare($file, $check);
	}




	// • === site »
	public static function site($check = true, $file = 'site')
	{
		return self::prepare($file, $check);
	}




	// • === bit »
	public static function bit($file, $check = true)
	{
		return self::prepare('bit.' . $file, $check);
	}




	// • === head »
	public static function head($file = null, $check = true)
	{
		if (!$file) {
			return self::bit('head', $check);
		}
		return self::bit('head.' . $file, $check);
	}




	// • === foot »
	public static function foot($file = null, $check = true)
	{
		if (!$file) {
			return self::bit('foot', $check);
		}
		return self::bit('foot.' . $file, $check);
	}




	// • === region »
	public static function region($file, $check = true)
	{
		return self::prepare('region.' . $file, $check);
	}




	// • === slice »
	public static function slice($file, $check = true)
	{
		return self::prepare('slice.' . $file, $check);
	}





	// • === header »
	public static function header($check = true, $file = 'header')
	{
		return self::slice($file, $check);
	}





	// • === footer »
	public static function footer($check = true, $file = 'footer')
	{
		return self::slice($file, $check);
	}




	// • === piece »
	public static function piece($file, $check = true)
	{
		return self::prepare('piece.' . $file, $check);
	}




	// • === silo »
	public static function silo($file, $check = true)
	{
		return self::piece('silo.' . $file, $check);
	}




	// • === collop »
	public static function collop($file, ?string $module = null, $check = true)
	{
		if (!empty($module)) {
			$file = $module . '.' . $file;
		}
		return self::prepare('collop.' . $file, $check);
	}




	// • === form »
	public static function form($file, $check = true)
	{
		return self::collop('form.' . $file, $check);
	}




	// • === frag »
	public static function frag($file, $module = null, $check = true)
	{
		if (!$module) {
			$module = RouteX::current('name');
			$module = StringX::beforeAnyAs($module, ['-', '.', '/']);
		}

		if (!empty($module)) {
			$file = $module . '.' . $file;
		}

		return self::resolve(ThemeX::prepare('frag.', $file), $check);
	}




	// • === slab »
	public static function slab($file, $component = null, $path = 'collop', $check = true)
	{
		$file = 'slab.' . $file;
		if (!empty($component)) {
			$file = $component . '.' . $file;
		}
		if (!empty($path)) {
			$paths = ['page', 'collop', 'frag'];
			if (in_array($path, $paths)) {
				return self::{$path}($file, $check);
			}
		}
		$file = StringX::crop()->begin($file, 'slab.');
		return self::resolve(ThemeX::prepare('slab', $file), $check);
	}




	// • === nav »
	public static function nav($file = null)
	{
		if ($file) {
			return static::piece('nav.' . $file);
		}

		$calledClass = get_called_class();

		return new class ($calledClass) {

			protected $caller;


			public function __construct($caller)
			{
				$this->caller = $caller;
			}


			// ➝ primary
			public function primary($file = null)
			{
				$file = $file ? "primary.$file" : 'primary';
				return ($this->caller)::nav($file);
			}


			// ➝ secondary
			public function secondary($file = null)
			{
				$file = $file ? "secondary.$file" : 'secondary';
				return ($this->caller)::nav($file);
			}


			// ➝ topbar
			public function topbar($file = null)
			{
				$file = $file ? "topbar.$file" : 'topbar';
				return ($this->caller)::nav($file);
			}


			// ➝ sidebar
			public function sidebar($file = null)
			{
				$file = $file ? "sidebar.$file" : 'sidebar';
				return ($this->caller)::nav($file);
			}


			// ➝ header
			public function header($file = null)
			{
				$file = $file ? "header.$file" : 'header';
				return ($this->caller)::nav($file);
			}


			// ➝ footer
			public function footer($file = null)
			{
				$file = $file ? "footer.$file" : 'footer';
				return ($this->caller)::nav($file);
			}


			// ➝ bottom
			public function bottom($file = null)
			{
				$file = $file ? "bottom.$file" : 'bottom';
				return ($this->caller)::nav($file);
			}
		};
	}
}  // > end of class ~ LayoutX
