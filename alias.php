<?php //*** Alias ~ function » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

if (!function_exists('groyAlias')) {
	function groyAlias()
	{
		return [

			'BladeX' => Groy\Spine\Ally\BladeX::class,
			'CallerX' => Groy\Spine\Ally\CallerX::class,
			'LoadX' => Groy\Spine\Ally\LoadX::class,

			'CanX' => Groy\Spine\Core\CanX::class,
			'DebugX' => Groy\Spine\Core\DebugX::class,
			'EnvX' => Groy\Spine\Core\EnvX::class,
			'PathX' => Groy\Spine\Core\PathX::class,

			'WireX' => Groy\Wire\WireX::class,

			'ObjectX' => Groy\Xeno\Data\ObjectX::class,
			'RandomX' => Groy\Xeno\Data\RandomX::class,

			'FileX' => Groy\Xeno\File\FileX::class,
			'InFileX' => Groy\Xeno\File\InFileX::class,
			'IsFileX' => Groy\Xeno\File\IsFileX::class,

			'RedirectX' => Groy\Xeno\Http\RedirectX::class,
			'RequestX' => Groy\Xeno\Http\RequestX::class,
			'RouteX' => Groy\Xeno\Http\RouteX::class,

			'DecimalX' => Groy\Xeno\Number\DecimalX::class,
			'NumberX' => Groy\Xeno\Number\NumberX::class,

			'LayoutX' => Groy\Xeno\Theme\LayoutX::class,
			'PageX' => Groy\Xeno\Theme\PageX::class,
			'ThemeX' => Groy\Xeno\Theme\ThemeX::class,

			// 'NumberX' => Groy\Core\Number\NumberX::class,
			// 'RandomX' => Groy\Core\Data\RandomX::class,
			// 'RequestX' => Groy\Core\Http\RequestX::class,
		];
	}
}
 //> end of function ~ Alias