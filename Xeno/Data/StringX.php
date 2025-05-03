<?php //*** StringX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data;

use Illuminate\Support\Str;
use Groy\Xeno\Data\String\EndX;
use Groy\Xeno\Data\String\HasX;
use Groy\Xeno\Data\String\CaseX;
use Groy\Xeno\Data\String\CropX;
use Groy\Xeno\Data\String\SwapX;
use Groy\Xeno\Data\String\WordX;
use Groy\Xeno\Data\String\BeginX;
use Groy\Xeno\Data\String\SpaceX;
use Groy\Xeno\Data\String\StripX;

class StringX
{
	// • === is »
	public static function is($string, $strict = false)
	{
		if ($strict === true) {
			return is_string($string);
		} elseif (is_string($string)) {
			return true;
		} elseif (!is_null($string)) {
			$types = ['string', 'integer', 'double', 'numeric'];
			$type = gettype($string);
			if (in_array($type, $types)) {
				return true;
			}
		}
		return false;
	}




	// • === length »
	public static function length($string)
	{
		if (self::is($string)) {
			return strlen($string);
		}
	}




	// • === empty » is string & empty
	public static function empty($string)
	{
		return self::length($string) === 0;
	}




	// • === has » is string & not empty
	public static function has($string = null)
	{
		if ($string) {
			return HasX::something($string);
		}
		return new HasX;
	}




	// • === encoded » $var is string & encoded
	public static function encoded($string)
	{
		if (hasx::nothing($string)) {
			return false;
		}

		return new class ($string) {
			private string $string;


			// ➝ construct »
			public function __construct($string)
			{
				$this->string = $string;
			}


			// ➝ url » boolean
			public function url()
			{
				$decoded = urldecode($this->string);
				if ($decoded === $this->string) {
					return false;
				}
				$encoded = urlencode($decoded);
				return $encoded === $this->string;
			}
		};
	}




	// • === reverse »
	public static function reverse($string)
	{
		if (!empty($string)) {
			return strrev($string);
		}
		return null;
	}




	// • === in »
	public static function in($string, $needle, $case = true)
	{
		if (hasx::nothing($string) || !self::is($needle)) {
			return false;
		}

		if ($case) {
			return $needle === $string || strpos($string, $needle) !== false;
		}

		return $needle == $string || stripos($string, $needle) !== false;
	}




	// • === contain »
	public static function contain($string, $needle, $case = true)
	{
		if (hasx::nothing($string)) {
			return false;
		}

		if (strtolower($needle) === 'space') {
			return strpos($string, ' ') !== false;
		}

		if (!$case) {
			$string = strtolower($string);
			$needle = strtolower($needle);
		}

		return str_contains($string, $needle);
	}




	// • === containAny »
	public static function containAny($string, array $needles, $case = true)
	{
		if (hasx::nothing($string)) {
			return false;
		}

		if (!$case) {
			$string = strtolower($string);
			$needles = array_map('strtolower', $needles);
		}

		array_walk($needles, function (&$item) {
			if (strtolower($item) === 'space') {
				$item = ' ';
			}
		});

		foreach ($needles as $needle) {
			if (str_contains($string, $needle)) {
				return true;
			}
		}

		return false;
	}




	// • === compare »
	public static function compare($string, $needle, $strict = true)
	{
		if (hasx::nothing($string) || hasx::nothing($needle)) {
			return false;
		}
		return $strict ? $string === $needle : strtolower($string) == strtolower($needle);
	}




	// • === nth » nth character
	public static function nth($string, $nth)
	{
		if (hasx::nothing($string)) {
			return false;
		}

		if (!is_numeric($nth) || (int) $nth < 1) {
			return false;
		}

		$nth = (int) $nth;
		$length = strlen($string);

		if ($nth > $length) {
			return false;
		}

		return $string[$nth - 1];
	}




	// • === first »
	public static function first($string)
	{
		return self::nth($string, 1);
	}




	// • === last »
	public static function last($string)
	{
		if (hasx::nothing($string)) {
			return false;
		}
		return substr($string, -1);
	}




	// • === occurrence » count
	public static function occurrence($string, $needle, $offset = 0, $length = null)
	{
		if (hasx::nothing($string) || hasx::nothing($needle) || !is_numeric($offset)) {
			return false;
		}

		$stringLength = strlen($string);

		$offset = (int) $offset;
		if ($offset < 0 || $offset >= $stringLength) {
			return false;
		}

		if ($length !== null) {
			$length = (int) $length;
			if ($length < 0) {
				return false;
			}

			if (($offset + $length) > $stringLength) {
				$length = ($stringLength - $offset);
			}
		}
		return substr_count($string, $needle, $offset, $length);
	}




	// • === occurrenceNth » get position of nth occurrence
	public static function occurrenceNth($string, $character, $nth)
	{
		if (hasx::nothing($string) || hasx::nothing($character) || !is_numeric($nth)) {
			return false;
		}

		$position = -1;
		$nth = (int) $nth;
		while ($nth > 0) {
			$position = strpos($string, $character, $position + 1);
			if ($position === false) {
				return false;
			}
			$nth--;
		}

		return $position;
	}




	// • === occurrenceGroupNth »
	public static function occurrenceGroupNth($string, $separator, $nth, $return = 'nth')
	{
		if (hasx::nothing($string) || !is_numeric($nth)) {
			return false;
		}

		$parts = explode($separator, $string);
		$groups = [];
		$nth = (int) $nth;

		for ($i = 0; $i < count($parts); $i += $nth) {
			$chunk = array_slice($parts, $i, $nth);
			$groups[] = implode($separator, $chunk);
		}

		switch (strtolower($return)) {
			case 'nth':
				return $groups[$nth - 1] ?? false;

			case 'first':
				return $groups[0] ?? false;

			case 'last':
				return end($groups);

			default:
				return $groups;
		}
	}




	// • === swap »
	public static function swap()
	{
		return new SwapX;
	}




	// • === space »
	public static function space()
	{
		return new SpaceX;
	}




	// • === strip »
	public static function strip()
	{
		return new StripX;
	}




	// • === crop »
	public static function crop()
	{
		return new CropX;
	}




	// • === case »
	public static function case()
	{
		return new CaseX;
	}




	// • === word »
	public static function word()
	{
		return new WordX;
	}




	// • === end »
	public static function end()
	{
		return new EndX;
	}




	// • === begin »
	public static function begin()
	{
		return new BeginX;
	}




	// • === noChar → remove special characters
	public static function noChar($string, $append = null)
	{
		if (hasx::nothing($string)) {
			return false;
		}

		$pattern = "A-Za-z0-9\-";
		if (is_array($append) && !empty($append)) {
			foreach ($append as $char) {
				$pattern .= $char;
			}
		} elseif (!self::empty($append)) {
			$pattern .= $append;
		}

		return preg_replace('/[^' . $pattern . ']/', '', $string);
	}




	// • === separate » space string based on characters
	public static function separate($string, string|array $separator = ['/', '-', '_', '.'])
	{
		if (hasx::nothing($string) || empty($separator)) {
			return false;
		}

		if (self::is($separator)) {
			return SwapX::withSpace($string, $separator);
		}

		foreach ($separator as $delimiter) {
			$string = SwapX::withSpace($string, $delimiter);
		}

		return $string;
	}




	// • === singular »
	public static function singular($string)
	{
		return Str::singular($string);
	}




	// • === plural »
	public static function plural($string, $quantity = 2)
	{
		return Str::plural($string, $quantity);
	}




	// • === toArray → string to array »
	public static function toArray($string, $separator = null, $case = false)
	{
		if (HasX::nothing($string)) {
			return false;
		}

		if ($separator === null) {
			return str_split($string);
		}

		if ($separator === 'space') {
			return array_filter(array_map('trim', explode(' ', $string)), fn($v) => $v !== '');
		}

		if (!self::empty($string)) {
			return array_filter(array_map('trim', explode($separator, $string)), fn($v) => $v !== '');
		}

		return false;
	}




	// • === toObject → string to object »
	public static function toObject($string, $separator, $keySeparator)
	{
		if (HasX::nothing($string) || !self::is($separator)) {
			return false;
		}

		$pairs = explode($separator, trim($string));
		$object = new \stdClass();

		foreach ($pairs as $pair) {
			$pair = trim($pair);
			if (!empty($pair)) {
				$parts = array_map('trim', explode($keySeparator, $pair, 2));

				if (count($parts) === 2 && $parts[0] !== '') {
					$object->{$parts[0]} = $parts[1];
				}
			}
		}

		return $object;
	}




	// • === before → string before character
	public static function before($string, $needle, $strip = true, $case = false)
	{
		if (hasx::nothing($string) || !self::in($string, $needle, $case)) {
			return false;
		}

		if (!$case) {
			$pos = stripos($string, $needle);
		} else {
			$pos = strpos($string, $needle);
		}
		if ($pos && $pos != 0) {
			$res = substr($string, 0, $pos);
		}
		if (!$strip) {
			$res = $res . $needle;
		}
		if (isset($res)) {
			return $res;
		}
	}




	// • === beforeAs → string before character or the string
	public static function beforeAs($string, $needle, $strip = true, $case = false)
	{
		$stringBefore = self::before($string, $needle, $strip, $case);
		if ($stringBefore === false) {
			return $string;
		}
		return $stringBefore;
	}




	// • === beforeAnyAs »
	public static function beforeAnyAs($string, array $needle, $strip = true, $case = false)
	{
		if (!empty($needle)) {
			foreach ($needle as $seed) {
				$stringBefore = self::before($string, $seed, $strip, $case);
				if ($stringBefore) {
					return $stringBefore;
				}
			}
		}
		return $string;
	}




	// • === after → string after character
	public static function after($string, $needle, $strip = true, $case = false, $occurrence = 'first')
	{
		if (hasx::nothing($string) || !self::in($string, $needle, $case)) {
			return false;
		}

		if ($case) {
			$string = strstr($string, $needle);
		} else {
			$string = stristr($string, $needle);
		}

		if ($string !== false) {
			if ($strip === true && $occurrence === 'first') {
				$string = SwapX::first($string, $needle, '', $case);
			} elseif ($occurrence === 'last') {
				if ($case) {
					$pos = strrpos($string, $needle);
				} else {
					$pos = strripos($string, $needle);
				}
				if ($pos !== false) {
					$string = substr($string, $pos + strlen($needle));
				}
				if ($strip === false) {
					$string = $needle . $string;
				}
			}
		}

		return $string;
	}




	// • === afterFirst → string after first occurrence of a character » string, false
	public static function afterFirst($string, $needle, $strip = true, $case = false)
	{
		return self::after($string, $needle, $strip, $case, 'first');
	}




	// • === afterLast → string after last occurrence of a character » string, false
	public static function afterLast($string, $needle, $strip = true, $case = false)
	{
		return self::after($string, $needle, $strip, $case, 'last');
	}




	// • === afterAs → string after character or the string
	public static function afterAs($string, $needle, $strip = true, $case = false, $occurrence = 'first')
	{
		$stringAfter = self::after($string, $needle, $strip, $case, $occurrence);
		if ($stringAfter === false) {
			return $string;
		}
		return $stringAfter;
	}




	// • === afterFirstAs → string after character or the string
	public static function afterFirstAs($string, $needle, $strip = true, $case = false)
	{
		$stringAfter = self::afterFirst($string, $needle, $strip, $case);
		if (!$stringAfter) {
			return $string;
		}
		return $stringAfter;
	}




	// • === afterLastAs → string after character or the string
	public static function afterLastAs($string, $needle, $strip = true, $case = false)
	{
		$stringAfter = self::afterLast($string, $needle, $strip, $case);
		if (!$stringAfter) {
			return $string;
		}
		return $stringAfter;
	}




	// • === surround » string before & after needle
	public static function surround($string, $needle, $strip = true, $case = false): bool
	{
		$before = self::before($string, $needle, $strip, $case);
		$after = self::after($string, $needle, $strip, $case);
		return !empty($before) && !empty($after);
	}




	// • === blur → blur censored character & vice-versa
	public static function blur($string, $library, $blur = '***', $case = false)
	{
		if (hasx::nothing($string) || empty($library)) {
			return false;
		}

		$words = explode(" ", $string);
		if (!is_array($library)) {
			if (self::contain($library, '|')) {
				$library = SwapX::all($library, ' | ', '|');
				$library = explode('|', $library);
			} elseif (self::contain($library, '-')) {
				$library = SwapX::all($library, ' - ', '-');
				$library = explode('-', $library);
			} elseif (self::contain($library, ',')) {
				$library = SwapX::all($library, ' , ', ',');
				$library = explode(',', $library);
			} else {
				$library = explode(' ', $library);
			}
		}

		foreach ($words as $word) {
			if (in_array(strtolower($word), array_map('strtolower', $library))) {
				$string = SwapX::all($string, $word, $blur, $case);
			}
		}

		return $string;
	}




	// • === match → match pattern » boolean, string, array
	public static function match($string, $pattern, $return = 'boolean', $flags = 0, $offset = 0)
	{
		if (HasX::nothing($string) || HasX::nothing($pattern)) {
			return false;
		}

		// → predefined pattern
		$patterns = [
			'uppercase' => "/^[A-Z]+$/",
			'lowercase' => "/^[a-z]+$/",
			'alpha' => "/^[A-Z]+$/i",
			'numeric' => "/^[0-9]+$/",
			'alphanumeric' => "/^[A-Z0-9]+$/i",
		];

		if (isset($patterns[$pattern])) {
			$pattern = $patterns[$pattern];
		}


		// → clean up pattern
		if (!BeginX::with($pattern, '/')) {
			$pattern = '/' . $pattern;
		}

		if (!EndX::with($pattern, '/')) {
			$pattern = $pattern . '/';
		}

		if ($return === 'matches' || $return === 'count') {
			$preg = preg_match_all($pattern, $string, $match, $flags, $offset);
		} else {
			$preg = preg_match($pattern, $string, $match, $flags, $offset);
		}

		if ($preg !== false) {
			if ($return === 'boolean' && $preg > 0) {
				return true;
			} elseif ($return === 'match' && $preg > 0 && is_array($match)) {
				return $match[0];
			} elseif ($return === 'matches' && $preg > 0 && is_array($match)) {
				return $match;
			} elseif ($return === 'count' && $preg > 0) {
				return $preg;
			}
		}
	}
} //> end of class ~ StringX