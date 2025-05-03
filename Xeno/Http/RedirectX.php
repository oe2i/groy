<?php //*** RedirectX ~ class » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Http;

use Illuminate\Http\RedirectResponse;

class RedirectX
{
	// • === link »
	public static function link($to)
	{
		return redirect($to);
	}



	// • === route »
	public static function route($name, $param = [])
	{
		return redirect()->route($name, $param);
	}



	// • === back »
	public static function back($withInput = false)
	{
		if ($withInput) {
			return back()->withInput();
		}
		return back();
	}



	// • === form » back to form
	public static function form()
	{
		return self::back(true);
	}



	// • === controller »
	public static function controller($controller, $action, $param = [])
	{
		return redirect()->action([$controller, $action], $param);
	}



	// • === flash » with flash message
	public static function flash($to, $value, $key = 'status')
	{
		return redirect($to)->with($key, $value);
		// NOTE: Implementation -> how to use on $to [blade view] is below
		// @if (session($key))     <div class="alert alert-success">  {{ session($key) }}  </div>@endif
	}



	// • === withInput »
	public static function withInput($to)
	{
		return redirect($to)->withInput();
	}



	// • === away » to external url
	public static function away($url)
	{
		return redirect()->away($url);
	}
} //> end of class ~ RedirectX