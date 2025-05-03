<?php //*** DebugX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Core;

class DebugX
{
	// • === call »
	public function __call($method, $argument)
	{
		return self::unreachable(__CLASS__, $method, $argument, 'instance');
	}




	// • === callStatic »
	public static function __callStatic($method, $argument)
	{
		return self::unreachable(__CLASS__, $method, $argument, 'static');
	}




	// • === extra »
	private static function extra($extra)
	{
		if (is_array($extra)) {
			if (array_keys($extra) === range(0, count($extra) - 1)) {
				return implode(' • ', $extra);
			}

			return implode(' • ', array_map(
				fn($key, $val) => $key . ': ' . (is_callable($val) ? self::closure($val) : $val),
				array_keys($extra),
				$extra
			));
		}

		return (string) $extra;
	}




	// • === style »
	private static function style($flag): string
	{
		return match ($flag) {
			'label' => 'color:#FFD700;',
			'key' => 'color:#A52A2A;',
			'value' => 'color:#D2B48C; display: inline-block; padding-left: 2px;',
			'title' => 'color:#0F0F0F; margin:0; line-height:1.5; display:block;',
			'content' => 'color:purple;',
			'partition' => 'border-left: 1px dotted #FFD700; margin: 5px 8px; padding: 2px 6px; line-height:1.36',
			'container' => 'border: 1px dashed tan; padding: 5px 10px; margin-bottom:6px;',
			default => '',
		};
	}




	// • === array »
	private static function array(array $var): string
	{
		$output = '<em style="' . self::style('label') . '">is_array</em>';
		$output .= '<div style="' . self::style('partition') . '">';

		foreach ($var as $key => $value) {
			$output .= sprintf(
				'<div><strong style="%s">%s: </strong>%s</div>',
				self::style('key'),
				$key,
				self::value($value)
			);
		}

		$output .= '</div>';

		return $output;
	}




	// • === object »
	private static function object(object $var): string
	{
		$output = '<em style="' . self::style('label') . '">is_object</em>';
		$output .= '<div style="' . self::style('partition') . '">';

		foreach ($var as $key => $value) {
			$output .= sprintf(
				'<div><strong style="%s">%s → </strong>%s</div>',
				self::style('key'),
				$key,
				self::value($value)
			);
		}

		$output .= '</div>';

		return $output;
	}




	// • === value »
	private static function value($value): string
	{
		$contentStyle = self::style('content');
		return match (true) {
			is_string($value), is_numeric($value) => sprintf('<span style="%s">%s</span>', $contentStyle, $value),
			is_bool($value) => sprintf('<span style="%s">%s</span>', $contentStyle, $value ? 'True' : 'False'),
			is_null($value) => sprintf('<span style="%s">Null</span>', $contentStyle),
			is_callable($value) => sprintf('<span style="%s">Closure</span>', $contentStyle),
			is_array($value) => self::array($value),
			is_object($value) => self::object($value),
			default => sprintf('<span style="%s">Unknown</span>', $contentStyle),
		};
	}




	// • === null »
	private static function null($var)
	{
		return self::value($var);
	}




	// • === boolean »
	private static function boolean(bool $var)
	{
		return '<strong style="' . self::style('key') . '">Boolean: </strong>' . self::value($var);
	}




	// • === string »
	private static function string(string $var)
	{
		return self::value($var);
	}




	// • === dump »
	public static function dump($var, ?string $title = null)
	{
		$output = '<div style="' . self::style('container') . '">';

		if (!empty($title)) {
			$output .= '<strong style="' . self::style('title') . '">' . $title . '</strong> ';
		}

		$output .= match (true) {
			is_null($var) => self::null($var),
			is_bool($var) => self::boolean($var),   // Booleans should be checked before scalar
			is_scalar($var) => self::string($var),    // Scalars include integers, floats, strings, and booleans
			is_array($var) => self::array($var),     // Arrays should be checked separately
			is_object($var) => self::object($var),    // Objects should come after arrays
			is_iterable($var) => '<em>Iterable</em>',   // `is_iterable` should follow arrays and objects
			is_callable($var) => '<em>Callable</em>',   // Check for callable after iterable
			is_resource($var) => '<em>Resource</em>',   // Resources should be near the end
			default => '<em>Unknown type</em>'
		};

		$output .= '</div>';
		echo $output;
	}




	// • === vars »
	public static function vars(...$vars)
	{
		return self::dump($vars);
	}




	// • === exit »
	public static function exit($var, string $title = 'Groy™')
	{
		self::dump($var, $title);
		exit;
	}




	// • === print »
	public static function print(...$var)
	{
		return self::dump(['Groy™' => $var]);
	}




	// • === run »
	public static function run($var)
	{
		echo '<pre>' . var_export($var, true) . '</pre>' . "\n\r";
	}




	// • === oversight »
	public static function oversight($label, $message, $extra = null, $trace = null)
	{
		if (strpos($label, 'Groy') === false) {
			$label = 'Groy™ • ' . $label;
		}

		$e = '<strong>' . ucwords($label) . '</strong> | ' . ucfirst($message);

		if (!empty($extra)) {
			$e .= ' → [<em>' . self::extra($extra) . '</em>]';
		}

		if (!empty($trace)) {
			$e .= ' <br><span style="color: red;">{' . $trace['file'] . ':' . $trace['line'] . '}</span>';
		}

		return self::exit($e, null);
	}




	// • === unreachable » handles errors for unreachable methods
	public static function unreachable($class, $method, $argument, $type = null)
	{
		$indicator = match ($type) {
			'static' => '::',
			default => '→',
		};
		$caller = $class . $indicator . $method . '()';
		return self::oversight($class, 'method unreachable', $caller);
	}




	// • === trace »
	public static function trace($file, $line)
	{
		return ['file' => $file, 'line' => $line];
	}




	// • === caller »
	public static function caller($caller, $type, &$file = null)
	{
		if ($type === 'CLASS' && !class_exists($caller) || $type === 'FUNCTION' && !function_exists($caller)) {
			return self::oversight($caller, ucfirst(strtolower($type)) . ' unavailable!', $file);
		}
		return true;
	}




	// • === closure »
	public static function closure($closure)
	{
		$reflection = new \ReflectionFunction($closure);
		$closureName = $reflection->getName();
		return $closureName;
	}

} //> end of class ~ DebugX