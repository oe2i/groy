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





	// • === is » can be a string
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





	// • === length » no of characters or 0
	public static function length($string)
	{
		if (self::is($string)) {
			return strlen($string);
		}
		return 0;
	}





	// • === empty » is string & empty
	public static function empty($string)
	{
		return (self::is($string) && strlen($string) === 0);
	}





	// • === valid » is string & not empty
	public static function valid($string)
	{
		return (self::is($string) && strlen($string) >= 1);
	}





	// • === verified » [$argument] is string & not empty
	public static function verified(...$argument)
	{
		if (empty($argument)) {
			return false;
		}

		foreach ($argument as $string) {
			if (!self::valid($string)) {
				return false;
			}
		}

		return true;
	}





	// • === encoded » is string & encoded
	public static function encoded($string)
	{
		if (!self::verified($string)) {
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
		return $string;
	}





	// • === in »
	public static function in($string, $search, $case = true)
	{
		if (!self::verified($string, $search)) {
			return false;
		}

		if ($case) {
			return $search === $string || strpos($string, $search) !== false;
		}

		return $search == $string || stripos($string, $search) !== false;
	}





	// • === contain »
	public static function contain($string, $search, $case = true)
	{
		if (!self::verified($string)) {
			return false;
		}

		if (self::verified($search) && (strtolower($search) === 'space')) {
			return strpos($string, ' ') !== false;
		}

		if (!$case) {
			$string = strtolower($string);
			$search = strtolower($search);
		}

		return str_contains($string, $search);
	}





	// • === containAny »
	public static function containAny($string, $search, $case = true)
	{
		if (!self::verified($string) || empty($search)) {
			return false;
		}

		if (!is_array($search)) {
			return self::contain($string, $search, $case);
		}

		if (!$case) {
			$string = strtolower($string);
			$search = array_map('strtolower', $search);
		}

		array_walk($search, function (&$item) {
			if (strtolower($item) === 'space') {
				$item = ' ';
			}
		});

		foreach ($search as $needle) {
			if (str_contains($string, $search)) {
				return true;
			}
		}

		return false;
	}





	// • === compare »
	public static function compare($string, $search, $strict = true)
	{
		if (!self::verified($string, $search)) {
			return false;
		}

		return $strict ? $string === $search : strtolower($string) == strtolower($search);
	}





	// • === nth » nth character
	public static function nth($string, $nth)
	{
		if (!self::verified($string)) {
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
		if (!self::verified($string)) {
			return false;
		}

		return substr($string, -1);
	}





	// • === occurrence » count
	public static function occurrence($string, $search, $offset = 0, $length = null)
	{
		if (!self::verified($string, $search) || !is_numeric($offset)) {
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

		return substr_count($string, $search, $offset, $length);
	}





	// • === occurrenceNth » get position of nth occurrence
	public static function occurrenceNth($string, $character, $nth)
	{
		if (!self::verified($string, $character) || !is_numeric($nth)) {
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
		if (!self::verified($string) || !is_numeric($nth)) {
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





	// • === has »
	public static function has()
	{
		return new HasX;
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
		if (!self::verified($string)) {
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
		if (!self::verified($string) || empty($separator)) {
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
		if (!self::verified($string)) {
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
		if (!self::verified($string) || !self::is($separator)) {
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
	public static function before($string, $search, $strip = true, $case = false)
	{
		if (!self::verified($string) || !self::contain($string, $search, $case)) {
			return false;
		}

		if (!$case) {
			$pos = stripos($string, $search);
		} else {
			$pos = strpos($string, $search);
		}

		if ($pos && $pos != 0) {
			$res = substr($string, 0, $pos);
		}

		if (!$strip) {
			$res = $res . $search;
		}

		if (isset($res)) {
			return $res;
		}

		return false;
	}





	// • === beforeAs → string before character or the string
	public static function beforeAs($string, $search, $strip = true, $case = false)
	{
		$res = self::before($string, $search, $strip, $case);
		if ($res === false) {
			return $string;
		}
		return $res;
	}





	// • === beforeAnyAs »
	public static function beforeAnyAs($string, array $search, $strip = true, $case = false)
	{
		if (!empty($search)) {
			foreach ($search as $needle) {
				$res = self::before($string, $needle, $strip, $case);
				if ($res) {
					return $res;
				}
			}
		}
		return $string;
	}





	// • === after → string after character
	public static function after($string, $search, $strip = true, $case = false, $occurrence = 'first')
	{
		if (!self::verified($string) || !self::contain($string, $search, $case)) {
			return false;
		}

		if ($case) {
			$string = strstr($string, $search);
		} else {
			$string = stristr($string, $search);
		}

		if ($string !== false) {
			if ($strip === true && $occurrence === 'first') {
				$string = SwapX::first($string, $search, '', $case);
			} elseif ($occurrence === 'last') {

				if ($case) {
					$pos = strrpos($string, $search);
				} else {
					$pos = strripos($string, $search);
				}

				if ($pos !== false) {
					$string = substr($string, $pos + strlen($search));
				}

				if ($strip === false) {
					$string = $search . $string;
				}
			}
		}

		return $string;
	}





	// • === afterFirst → string after first occurrence of a character » string, false
	public static function afterFirst($string, $search, $strip = true, $case = false)
	{
		return self::after($string, $search, $strip, $case, 'first');
	}





	// • === afterLast → string after last occurrence of a character » string, false
	public static function afterLast($string, $search, $strip = true, $case = false)
	{
		return self::after($string, $search, $strip, $case, 'last');
	}





	// • === afterAs → string after character or the string
	public static function afterAs($string, $search, $strip = true, $case = false, $occurrence = 'first')
	{
		$res = self::after($string, $search, $strip, $case, $occurrence);

		if ($res === false) {
			return $string;
		}

		return $res;
	}





	// • === afterFirstAs → string after character or the string
	public static function afterFirstAs($string, $search, $strip = true, $case = false)
	{
		$res = self::afterFirst($string, $search, $strip, $case);

		if (!$res) {
			return $string;
		}

		return $res;
	}





	// • === afterLastAs → string after character or the string
	public static function afterLastAs($string, $search, $strip = true, $case = false)
	{
		$res = self::afterLast($string, $search, $strip, $case);

		if (!$res) {
			return $string;
		}

		return $res;
	}





	// • === surround » string before & after needle
	public static function surround($string, $search, $strip = true, $case = false): bool
	{
		$before = self::before($string, $search, $strip, $case);
		$after = self::after($string, $search, $strip, $case);
		return !empty($before) && !empty($after);
	}





	// • === blur → blur censored character & vice-versa
	public static function blur($string, $library, $blur = '***', $case = false)
	{
		if (!self::verified($string) || empty($library)) {
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
		if (!self::verified($string) || HasX::nothing($pattern)) {
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