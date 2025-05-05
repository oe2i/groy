<?php //*** AssetX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Skin;

use Groy\Xeno\Vine\ProjectX;
use Groy\Xeno\File\FileX;
use Groy\Xeno\Data\StringX;
use Groy\Xeno\Core\EnvX;
use Groy\Xeno\Core\DebugX;


class AssetX
{
	// • property
	private static bool $init = false;
	private static string $path = '';




	// • === init »
	private static function init()
	{
		if (! self::$init) {
			$path = strtolower(EnvX::asset());
			if ($path === 'theme') {
				self::$path = ThemeX::name().'/';
			} elseif ($path === 'asset') {
				self::$path = 'asset/';
			} elseif (! empty($path)) {
				self::$path = StringX::end()->ifNot($path, '/');
			}
			self::$init = true;
		}
	}




	// • === is » is file an asset
	private static function is($file)
	{
		self::init();
		$file = StringX::swap()->ps($file, DIRECTORY_SEPARATOR);
		return FileX::is()->public($file);
	}




	// • === e404 »
	public static function e404($file, $message = 'resource unavailable', $label = 'AssetX')
	{
		return DebugX::oversight($label, $message, $file);
	}




	// • === file »
	public static function file($file, $check = true, $baseurl = false)
	{
		self::init();
		if (! empty(self::$path)) {
			$file = self::$path.$file;
		}

		if ($check && ! self::is($file)) {
			return self::e404($file);
		}

		$asset = asset($file);

		if (! $baseurl) {
			return StringX::crop()->begin($asset, url('/'));
		}
		return $asset;
	}




	// • === favicon »
	public static function favicon($favicon, $check = true, $baseurl = false)
	{
		return self::file('favicon/'.$favicon, $check, $baseurl);
	}




	// • === logo »
	public static function logo($logo = null, $check = true, $baseurl = false)
	{
		$logo = ! empty($logo) ? $logo : strtolower(ProjectX::alias()).'.png';
		return self::file('logo/'.$logo, $check, $baseurl);
	}




	// • === image »
	public static function image($image, $check = true, $baseurl = false)
	{
		return self::file('image/'.$image, $check, $baseurl);
	}




	// • === illustration »
	public static function illustration($illustration, $check = true, $baseurl = false)
	{
		return self::file('illustration/'.$illustration, $check, $baseurl);
	}




	// • === media »
	public static function media($media, $check = true, $baseurl = false)
	{
		return self::file('media/'.$media, $check, $baseurl);
	}




	// • === svg »
	public static function svg($svg, $check = true, $baseurl = false)
	{
		$svg = StringX::end()->ifNot($svg, '.svg');
		return self::media('svg/'.$svg, $check, $baseurl);
	}




	// • === png »
	public static function png($png, $check = true, $baseurl = false)
	{
		$png = StringX::end()->ifNot($png, '.png');
		return self::media('png/'.$png, $check, $baseurl);
	}




	// • === gif »
	public static function gif($gif, $check = true, $baseurl = false)
	{
		$gif = StringX::end()->ifNot($gif, '.gif');
		return self::media('gif/'.$gif, $check, $baseurl);
	}




	// • === js »
	public static function js($js, $check = true, $baseurl = false)
	{
		$js = StringX::end()->ifNot($js, '.js');
		return self::file('js/'.$js, $check, $baseurl);
	}




	// • === css »
	public static function css($css, $check = true, $baseurl = false)
	{
		$css = StringX::end()->ifNot($css, '.css');
		return self::file('css/'.$css, $check, $baseurl);
	}




	// • === vendor »
	public static function vendor($file, $check = false, $baseurl = false)
	{
		return self::file('vendor/'.$file, $check, $baseurl);
	}




	// • === fa » fontawesome
	public static function fa($file, $check = false, $baseurl = false)
	{
		return self::vendor('fontawesome/'.$file, $check, $baseurl);
	}




	// • === tag »
	public static function tag($file, $tag = null, $check = true, $baseurl = false)
	{
		if ($tag) {
			$tag = StringX::end()->ifNot($tag, '/');
		}
		return self::file($tag.$file, $check, $baseurl);
	}




	// • === href »
	public static function href($file, $type = null, $check = true, $baseurl = false)
	{
		if ($type === 'vendor') {
			return self::vendor($file, $check, $baseurl);
		}

		if ($type === 'fontawesome') {
			return self::fa($file, $check, $baseurl);
		}

		if ($type === 'css') {
			return self::css($file, $check, $baseurl);
		}

		if ($type === 'js') {
			return self::js($file, $check, $baseurl);
		}

		return self::tag($file, $type, $check, $baseurl);
	}
} //> end of class ~ AssetX