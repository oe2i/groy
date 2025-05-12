<?php //*** FormatX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Format;

use Groy\Xeno\Data\String\StripX;
use Groy\Xeno\Data\String\SpaceX;
use Groy\Xeno\Data\String\CaseX;
use Groy\Xeno\Data\StringX;

class FormatX
{
	// ◇ === aria »
	public static function aria($aria)
	{
		return ucfirst($aria);
	}




	// ◇ === name »
	public static function name()
	{
		return new NameX;
	}




	// ◇ === email »
	public static function email($email)
	{
		return strtolower($email);
	}




	// ◇ === html » format as HTML
	public static function html($content)
	{
		$content = trim($content);
		$lines = array_filter(explode("\n\n", $content));
		$output = '';

		foreach ($lines as $index => $line) {
			$line = nl2br(trim($line));
			$output .= '<p>' . $line . '</p>';
		}

		return StripX::paragraph($output);
	}





	// ◇ === title »
	public static function title($title)
	{
		if (StringX::valid($title)) {
			$firstChar = $title[0];
			if (CaseX::isLower($firstChar)) {
				if (CaseX::upperCount($title) > 0 && !SpaceX::has($title)) {
					$title = CaseX::upperToSpace($title);
				}
			} else {
				if (CaseX::upperCount($title) > 1) {
					$title = CaseX::upperToSpace($title);
				}
				$title = SpaceX::single($title);
			}
			return ucwords($title);
		}
	}












































	// • ==== label → ... »
	public static function label($label)
	{
		$label = StringX::contain($label, '.') ? StringX::afterLast($label, '.') : $label;
		return ucwords($label);
	}




	// • ==== id → ... »
	public static function id($id)
	{
		return StringX::swap($id, '.', '_');
	}




	// • ==== placeholder → ... »
	public static function placeholder($placeholder = null)
	{
		if (!empty($placeholder)) {
			$placeholder = ucwords(trim($placeholder)) . '...';
		}
		return $placeholder;
	}




	// • ==== trimParagraph • remove empty paragraph »
	public static function trimParagraph($html)
	{
		return preg_replace('/<p>\s*<\/p>/', '', $html);
	}




	// • ==== nl2brp • convert newline to line break or paragraph »
	public static function nl2brp($html)
	{
		$html = trim($html);
		$lines = explode("\n\n", $html);
		if (!empty($lines) && is_array($lines)) {
			$html = '';
			foreach ($lines as $index => $line) {
				if ($index < 1) {
					if (StringX::hasNL($line)) {
						$html .= nl2br($line);
					} else {
						$html .= $line;
					}
				}

				if ($index > 0) {
					$html .= '<p>' . nl2br($line) . '</p>';
				}

				$html = self::trimParagraph($html);
			}
		}
		return $html;
	}




	public static function toNaira($number)
	{
		//TODO: pre-check!
		$money = NumberX::format($number, 2);
		if ($money != '') {
			return '₦' . $money;
		}
	}



	public static function toDollar($number)
	{
		//TODO: pre-check!
		$money = NumberX::format($number, 2);
		if ($money != '') {
			return '$' . $money;
		}
	}


	// ◈ === var »
	public static function var(&$var, $format = 'string', $default = '')
	{
		$o = VarX::safe($var, $default);
		if (!empty($o)) {
			if ($format === 'capitalize') {
				return self::capitalize($o);
			}
		}
		return $o;
	}



	// ◈ === date »
	public static function date($date, $format = null)
	{
		if ($format === 'log') {
			$format = 'datetime';
		}
		if ($format === 'logdate') {
			$format = 'date';
		}
		if ($format === 'logtime') {
			$format = 'time';
		}
		return PeriodX::log($date, $format);
	}




	// ◈ === gender »
	public static function gender($gender)
	{
		return StringX::firstCap(GenderEnum::toValue($gender));
	}









	// ◈ === website »
	public static function website($var)
	{
		if (StringX::notBeginWithAny($var, ['https://', 'http://'])) {
			$var .= 'https://';
		}
		return $var;
	}




	// ◈ === capitalize »
	public static function capitalize($var)
	{
		$var = StringX::toCapitalize($var);
		$var = StringX::swap($var, '(hq)', '(HQ)');
		return $var;
	}




	// ◈ === uppercase »
	public static function uppercase($var)
	{
		return StringX::toUpperCase($var);
	}




	// ◈ === lowercase »
	public static function lowercase($var)
	{
		return StringX::toLowerCase($var);
	}




	// ◈ === param »
	public static function param(&$param, $key, $classMethod)
	{
		if (isset($param[$key])) {
			// $param[$key] = call_user_func($callable, $param[$key]);
			$param[$key] = call_user_func([self::class, $classMethod], $param[$key]);
		}
	}




	// ◈ === input »
	public static function input($input)
	{
		if (!empty($input) && is_array($input)) {
			self::param($input, 'name', 'name');
			self::param($input, 'acronym', 'uppercase');
			self::param($input, 'firm', 'capitalize');
			self::param($input, 'city', 'capitalize');
			self::param($input, 'email', 'lowercase');
			self::param($input, 'website', 'website');
			self::param($input, 'address', 'capitalize');
		}
		return $input;
	}






	// ◈ === label »
	public static function label2($label)
	{
		$label = StringX::contain($label, '.') ? StringX::afterLast($label, '.') : $label;
		$label = StringX::swapSpace($label, '_', true);
		return StringX::capitalize($label);
	}


} //> end of class ~ FormatX