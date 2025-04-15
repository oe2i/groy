<?php //*** StringX ~ class » Groy™ Library © April, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data;

use Illuminate\Support\Str;
use Yale\Orig\Is;
use Yale\Orig\Can;
use Yale\Orig\Has;

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



	// • === empty → is string & empty » boolean
	public static function empty($string)
	{
		return self::length($string) === 0;
	}



	// • === has → is string & not empty » boolean
	public static function has($string)
	{
		return self::length($string) > 0;
	}



	// • === encoded → $var is string & encoded » boolean
	public static function encoded($string)
	{
		if (!self::has($string)) {
			return false;
		}

		return new class($string) {
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



	// • === in » boolean
	public static function in($string, $needle, $case = true)
	{
		if (!self::has($string)) {
			return false;
		}

		if ($case) {
			return $needle === $string || strpos($string, $needle) !== false;
		}

		return $needle == $string || stripos($string, $needle) !== false;
	}



	// • === contain » boolean
	public static function contain($string, $needle, $case = true)
	{
		if (!self::has($string)) {
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



	// • === containAny » boolean
	public static function containAny($string, array $needles, $case = true)
	{
		if (!self::has($string)) {
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



	// • === compare » boolean
	public static function compare($string, $needle, $strict = true)
	{
		if (!self::has($string) || !self::has($needle)) {
			return false;
		}
		return $strict ? $string === $needle : strtolower($string) == strtolower($needle);
	}



	// • === nth → nth character » string
	public static function nth($string, $nth)
	{
		if (!self::has($string)) {
			return false;
		}

		if (!is_numeric($nth) || (int)$nth < 1) {
			return false;
		}

		$nth = (int) $nth;
		$length = strlen($string);

		if ($nth > $length) {
			return false;
		}

		return $string[$nth - 1];
	}



	// • === first » string
	public static function first($string)
	{
		return self::nth($string, 1);
	}



	// • === last » string
	public static function last($string)
	{
		if (!self::has($string)) {
			return false;
		}
		return substr($string, -1);
	}



	// • === occurrence → count » boolean, number
	public static function occurrence($string, $needle, $offset = 0, $length = null)
	{
		if (!self::has($string) || !self::has($needle) || !is_numeric($offset)) {
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
		if (!self::has($string) || !self::has($character) || !is_numeric($nth)) {
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
	// TODO: understand code and purpose, I wrote this a long time ago
	public static function occurrenceGroupNth($string, $separator, $nth, $req = 'nth')
	{
		$occurrence = [];
		$parts = explode($separator, $string);
		for ($i = 0; $i < count($parts); $i = $i + $nth) {
			$occurrence[] = implode($separator, array_slice($parts, $i, $i + $nth));
		}
		if (strtolower($req) === 'nth') {
			return $occurrence[$nth - 1];
		}
		return $occurrence;
	}



	// • === swap → replacement »
	public static function swap($string, $needle, $substitute, $occurrence = 'all', $case = false)
	{
		if (self::in($string, $needle, $case)) {
			if (strtolower($occurrence) === 'all') {
				if ($case) {
					$string = str_replace($needle, $substitute, $string);
				} else {
					$string = str_ireplace($needle, $substitute, $string);
				}
			} else {
				if (strtolower($occurrence) === 'first') {
					if ($case) {
						$pos = strpos($string, $needle);
					} else {
						$pos = stripos($string, $needle);
					}
				}
				if (strtolower($occurrence) === 'last') {
					if ($case) {
						$pos = strrpos($string, $needle);
					} else {
						$pos = strripos($string, $needle);
					}
				}
				if ($pos !== false) {
					return substr_replace($string, $substitute, $pos, strlen($needle));
				}
			}
		}
		return $string;
	}



	// • === swapDS → swap directory separator »
	public static function swapDS($string, $swap, $occurrence = 'all')
	{
		return self::swap($string, DIRECTORY_SEPARATOR, $swap, $occurrence);
	}



	// • === swapPS → swap directory separator »
	public static function swapPS($string, $swap, $occurrence = 'all')
	{
		return self::swap($string, '/', $swap, $occurrence);
	}



	// • === swapFirst → replace first occurrence »
	public static function swapFirst($string, $needle, $substitute = '', $case = false)
	{
		return self::swap($string, $needle, $substitute, 'first', $case);
	}



	// • === swapLast → replace last occurrence »
	public static function swapLast($string, $needle, $substitute = '', $case = false)
	{
		return self::swap($string, $needle, $substitute, 'last', $case);
	}



	// • === swapSpace → replace space character & vice-versa »
	public static function swapSpace($string, $needle, $inverse = false)
	{
		if (!self::empty($string) && self::is($needle)) {
			if (!$inverse && self::contain($string, 'space')) {
				return self::swap($string, ' ', $needle);
			} elseif ($inverse && self::contain($string, $needle)) {
				return self::swap($string, $needle, ' ');
			}
			return $string;
		}
		return false;
	}



	// • === singleSpace → ... » boolean
	public static function singleSpace($string)
	{
		return preg_replace('/\s+/', ' ', $string);
	}



	// • === noSpace → ... » boolean
	public static function noSpace($string)
	{
		return self::swap($string, ' ', '');
	}


	// • === noChar → remove special characters
	public static function noChar($string, $append = null)
	{
		if (!self::empty($string)) {
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
		return false;
	}



	// • === strip → remove from occurrence from string »
	public static function strip($string, $needle, $case = false)
	{
		return self::swap($string, $needle, '', 'all', $case);
	}



	// • === stripFirst → remove from first occurrence from string »
	public static function stripFirst($string, $needle, $case = false)
	{
		return self::swapFirst($string, $needle, '', $case);
	}



	// • === stripLast → remove from last occurrence from string »
	public static function stripLast($string, $needle, $case = false)
	{
		return self::swapLast($string, $needle, '', $case);
	}



	// • === stripNth → remove nth character from string »
	public static function stripNth($string, $nth, $number = null)
	{
		if (!$number) {
			if ($nth <= 0 || $nth > strlen($string)) {
				return $string;
			}
			return substr($string, 0, $nth - 1) . substr($string, $nth);
		} else {
			if ($nth <= 0 || $nth > strlen($string) || $x <= 0) {
				return $string;
			}
			$start = substr($string, 0, $nth - 1);
			$end = substr($string, $nth + $x - 1);
			return $start . $end;
		}
	}



	// • === crop → trim edges or character(s) »
	public static function crop($string, $needle = 'space', $case = false)
	{
		if (!self::empty($string) && !self::empty($needle)) {
			if (strtolower($needle) === 'space') {
				return trim($string);
			} elseif (self::in($string, $needle, $case)) {
				$string = trim($string);
				return trim($string, $needle);
			}
			return $string;
		}
		return false;
	}



	// • === cropBegin → remove beginning of string »
	public static function cropBegin($string, $needle, $case = false)
	{
		if (self::beginWith($string, $needle)) {
			return self::stripFirst($string, $needle, $case);
		}
		return $string;
	}


	// • === cropBeginNth → crop from beginning of string to nth position »
	public static function cropBeginNth($string, $nth)
	{
		return substr($string, $nth);
	}



	// • === cropEnd → remove end of string »
	public static function cropEnd($string, $needle, $case = false)
	{
		if (self::endWith($string, $needle)) {
			return self::stripLast($string, $needle, $case);
		}
		return $string;
	}



	// • === cropEndNth → crop from ending of string to nth position »
	public static function cropEndNth($string, $nth)
	{
		return substr($string, 0, $nth);
	}


	// • === before → string before character
	public static function before($string, $needle, $strip = true, $case = false)
	{
		if (!self::empty($string) && self::in($string, $needle, $case)) {
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
		return false;
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



	// • === after → string after character
	public static function after($string, $needle, $strip = true, $case = false, $occurrence = 'FIRST')
	{
		if (!self::empty($string) && self::in($string, $needle, $case)) {
			if ($case) {
				$string = strstr($string, $needle);
			} else {
				$string = stristr($string, $needle);
			}
			if ($string !== false) {
				if ($strip === true && $occurrence === 'FIRST') {
					$string = self::swapFirst($string, $needle, '', $case);
				} elseif ($occurrence === 'LAST') {
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
				return $string;
			}
		}
		return false;
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
	public static function afterAs($string, $needle, $strip = true, $case = false, $occurrence = 'FIRST')
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
		if (!self::empty($string) && !empty($library)) {
			$words = explode(" ", $string);
			if (!is_array($library)) {
				if (self::contain($library, '|')) {
					$library = self::swap($library, ' | ', '|');
					$library = explode('|', $library);
				} elseif (self::contain($library, '-')) {
					$library = self::swap($library, ' - ', '-');
					$library = explode('-', $library);
				} elseif (self::contain($library, ',')) {
					$library = self::swap($library, ' , ', ',');
					$library = explode(',', $library);
				} else {
					$library = explode(' ', $library);
				}
			}
			foreach ($words as $word) {
				if (in_array(strtolower($word), array_map('strtolower', $library))) {
					$string = self::swap($string, $word, $blur, 'all', $case);
				}
			}
			return $string;
		}
		return false;
	}


	// • === isUppercase → is string upper case » boolean
	public static function isUppercase($string)
	{
		return Is::uppercase($string);
	}



	// • === isLowercase → is string lower case » boolean
	public static function isLowercase($string)
	{
		return Is::lowercase($string);
	}



	// • === isMixedcase → is string lower & upper case » boolean
	public static function isMixedcase($string)
	{
		return Is::mixedcase($string);
	}



	// • === isNumbers → is string numbers » boolean
	public static function isNumber($string)
	{
		return Is::number($string);
	}

	// • === hasNumber → string contains numbers »
	public static function hasNumber($string)
	{
		return Has::number($string);
	}



	// • === hasLetter → string contains letters »
	public static function hasLetter($string)
	{
		return Has::letter($string);
	}



	// • === hasSpace → string has space »
	public static function hasSpace($string)
	{
		return Has::space($string);
	}



	// • === hasNewline → string has newline »
	public static function hasNewline($string)
	{
		return Has::newline($string);
	}



	// • === hasParagraph → string has multiple consecutive newline »
	public static function hasParagraph($string)
	{
		return Has::paragraph($string);
	}


	// • === begin → check string beginning » boolean
	public static function beginWith($string, $begin)
	{
		if (!self::empty($string) && !self::empty($begin)) {
			$string = trim($string);
			if (function_exists('str_starts_with')) {
				return str_starts_with($string, $begin);
			} else {
				return strpos($string, $begin) === 0;
			}
		}
		return false;
	}



	// • === beginWithAny → check if string begin with anything in array or comma separated string » string, boolean
	public static function beginWithAny($string, $begins)
	{

		if (is_string($begins)) {
			if (self::contain($begins, ',')) {
				$begins = explode(',', $begins);
			} elseif (self::beginWith($string, $begins)) {
				return $begins;
			}
		}

		foreach ($begins as $prefix) {
			if (substr($string, 0, strlen($prefix)) === $prefix) {
				return $prefix;
			}
		}

		return false;
	}


	// • === endWith → check string ending » boolean
	public static function endWith($string, $end)
	{
		if (!self::empty($string) && !self::empty($end)) {
			$string = trim($string);
			if (function_exists('str_ends_with')) {
				return str_ends_with($string, $end);
			} else {
				$length = strlen($end);
				return $length > 0 ? substr($string, -$length) === $end : true;
			}
		}
		return false;
	}



	// • === endWithAny → check if string ends with anything in array or comma separated string » string, boolean
	public static function endWithAny($string, $endings)
	{

		if (is_string($endings)) {
			if (self::contain($endings, ',')) {
				$endings = explode(',', $endings);
			} elseif (self::endWith($string, $endings)) {
				return $endings;
			}
		}

		for ($i = count($endings) - 1; $i >= 0; $i--) {
			$suffix = $endings[$i];
			if (substr($string, -strlen($suffix)) === $suffix) {
				return $suffix;
			}
		}

		return false;
	}



	// • === endWithNewline » check if string ends with newline
	public static function endWithNewline($string)
	{
		return preg_match('/(\r?\n)$/', $string);
	}



	// • === match → match pattern » boolean, string, array
	public static function match($string, $pattern, $return = 'boolean', $flags = 0, $offset = 0)
	{


		if (!self::empty($pattern)) {
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
		}

		if (!self::empty($string)) {

			// → clean up pattern
			if (!self::beginWith($pattern, '/')) {
				$pattern = '/' . $pattern;
			}
			if (!self::endWith($pattern, '/')) {
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
		return false;
	}



	// • === toObject → string to object »
	public static function toObject($string, $separator, $keySeparator)
	{
		$pairs = explode($separator, trim($string));
		$object = new \stdClass();
		if (is_array($pairs) && !empty($pairs)) {
			foreach ($pairs as $pair) {
				$pair = trim($pair);
				if (!empty($pair)) {
					list($key, $value) = array_map('trim', explode($keySeparator, $pair, 2));
					$object->$key = $value;
				}
			}
		}
		return $object;
	}



	// • === toArray → string to array »
	public static function toArray($string, $separator = null, $case = false)
	{
		if (!self::empty($string)) {
			if (is_null($separator)) {
				$array = str_split($string);
			}

			if ($separator === 'space') {
				$array = array_map('trim', explode(' ', $string));
			}

			if (!self::empty($string)) {
				$array = array_map('trim', explode($separator, $string));
			}

			if (isset($array)) {
				return $array;
			}
		}
		return false;
	}



	// • === toUppercase →
	public static function toUppercase($string)
	{
		if (self::is($string)) {
			return strtoupper($string);
		}
		return false;
	}



	// • === toLowercase →
	public static function toLowercase($string)
	{
		if (self::is($string)) {
			return strtolower(trim($string));
		}
		return false;
	}



	// • === toSentenceCase →
	public static function toSentenceCase($string)
	{
		if (self::is($string)) {
			return ucfirst(strtolower($string));
		}
		return false;
	}



	// • === toSnakeCase →
	public static function toSnakeCase($string, $separator = null)
	{
		if (!empty($separator)) {
			$words = explode($separator, $string);
		} else {
			$words = explode(' ', $string);
		}
		foreach ($words as $key => $word) {
			if (self::isUppercase($word)) {
				$words[$key] = strtolower($word);
			}
		}
		$string = implode(' ', $words);
		$string = preg_replace('/\s+/u', '', ucwords($string));
		$string = preg_replace('/(.)(?=[A-Z])/u', '$1_', $string);
		return strtolower($string);
	}



	// • === toCamelCase →
	public static function toCamelCase($string, $separator = null)
	{
		if (!empty($separator)) {
			$words = explode($separator, $string);
			foreach ($words as $key => $word) {
				if (self::isUppercase($word)) {
					$words[$key] = strtolower($word);
				}
				$string = implode(' ', $words);
			}
		}
		$string = preg_replace('/[^a-zA-Z0-9]+/', ' ', $string);
		$string = strtolower($string);
		$string = ucwords($string);
		$string = str_replace(' ', '', $string);
		$string = lcfirst($string);
		return $string;
	}



	// • === toCapitalize →
	public static function toCapitalize($string)
	{
		return ucwords(self::toSentenceCase($string));
	}



	// • === uppercaseCount →
	public static function uppercaseCount($string)
	{
		$pattern = '/[A-Z]/';
		return preg_match_all($pattern, $string);
	}



	// • === uppercaseToSpace →
	public static function uppercaseToSpace($string)
	{
		return preg_replace('/([a-z])([A-Z])/', '$1 $2', $string);
	}



	// • === getUppercase → get upper case letter & positions » array, boolean [false]
	public static function getUppercase($string)
	{
		preg_match_all('/[A-Z]/', $string, $matches, PREG_OFFSET_CAPTURE);
		if (!empty($matches[0])) {
			$matches = $matches[0];
			$upperCase = [];
			foreach ($matches as $match) {
				$upperCase[$match[1]] = $match[0];
			}
			return $upperCase;
		}
		return false;
	}



	// • === getLowercase → get lower case letter & positions » array, boolean [false]
	public static function getLowercase($string)
	{
		preg_match_all('/[a-z]/', $string, $matches, PREG_OFFSET_CAPTURE);
		if (!empty($matches[0])) {
			$matches = $matches[0];
			$upperCase = [];
			foreach ($matches as $match) {
				$upperCase[$match[1]] = $match[0];
			}
			return $upperCase;
		}
		return false;
	}



	// • === grabAcronym »
	public static function grabAcronym($string)
	{
		preg_match_all('/[A-Z]{2,}/', $string, $matches, PREG_OFFSET_CAPTURE);
		$found = $matches[0];
		if (!empty($found) && is_array($found)) {
			$var = [];
			foreach ($found as $key => $match) {
				$var[$key]['acronym'] = $match[0];
				$var[$key]['position'] = $match[1];
				// echo "Found '$matchedText' at position $position\n";
			}
			return $var;
		}
	}



	// • === hasAcronym »
	public static function hasAcronym($string)
	{
		return preg_match('/[A-Z]{2,}/', $string);
	}


	// • === sentenceCase »
	public static function sentenceCase($string, $acronym = true)
	{
		if (self::is($string)) {
			if ($acronym) {
				$found = self::grabAcronym($string);
				if (is_array($found) && !empty($found)) {
					foreach ($found as $key => $row) {
						$swap = '_' . RandomX::numeric(10) . '_';
						$found[$key]['swap'] = $swap;
						$string = self::swapFirst($string, $row['acronym'], $swap);
					}

					$string = strtolower($string);

					foreach ($found as $row) {
						$string = self::swapFirst($string, $row['swap'], $row['acronym']);
					}
				} else {
					$string = strtolower($string);
				}
			} else {
				$string = strtolower($string);
			}
			return ucfirst($string);
		}
		return false;
	}


	// • === space »
	public static function space($string, $separator = ['/', '-', '_', '.'])
	{
		if (!empty($separator)) {
			if (is_array($separator)) {
				foreach ($separator as $swap) {
					$string = self::swap($string, $swap, ' ');
				}
			} else {
				$string = self::swap($string, $separator, ' ');
			}
		}
		return $string;
	}


	// • === countWords »
	public static function count($string, $option = 'string')
	{
		if (self::is($string)) {
			if ($option === 'string') {
				return strlen($string);
			} elseif ($option === 'words') {
				return str_word_count($string);
			}
		}
		return false;
	}



	// • === countWord »
	public static function countWord($string)
	{
		return self::count($string, 'words');
	}


	// • === camelCase →
	public static function camelCase($string, $separator = null, $strip = true)
	{
		if (!empty($separator)) {
			$words = explode($separator, $string);
			foreach ($words as $key => $word) {
				if (self::isUppercase($word)) {
					$words[$key] = strtolower($word);
				}
				$string = implode(' ', $words);
			}
		}
		if (!$strip) {
			$string = self::swap($string, ' ', ' ' . $separator);
		}
		// $string = preg_replace('/[^a-zA-Z0-9]+/', ' ', $string); #removes special characters
		$string = strtolower($string);
		if (!$strip) {
			$string = ucwords($string, $separator);
		} else {
			$string = ucwords($string);
		}
		$string = str_replace(' ', '', $string);
		$string = lcfirst($string);
		return $string;
	}



	// • === firstCap »
	public static function firstCap($string)
	{
		return ucfirst(strtolower($string));
	}


	// • === sentence »
	public static function sentence($string, $acronym = true)
	{
		if (self::is($string)) {
			if ($acronym) {
				$found = self::grabAcronym($string);
				if (is_array($found) && !empty($found)) {
					foreach ($found as $key => $row) {
						$swap = '_' . RandomX::numeric(10) . '_';
						$found[$key]['swap'] = $swap;
						$string = self::swapFirst($string, $row['acronym'], $swap);
					}

					$string = strtolower($string);

					foreach ($found as $row) {
						$string = self::swapFirst($string, $row['swap'], $row['acronym']);
					}
				} else {
					$string = strtolower($string);
				}
			} else {
				$string = strtolower($string);
			}
			return ucfirst($string);
		}
		return false;
	}



	// • === capitalize →
	public static function capitalize($string)
	{
		return ucwords(self::sentence($string));
	}


	// • === lowercase →
	public static function lowercase($string)
	{
		if (self::is($string)) {
			return strtolower(trim($string));
		}
		return false;
	}



	// • === uppercase →
	public static function uppercase($string)
	{
		if (self::is($string)) {
			return strtoupper($string);
		}
		return false;
	}


	// • === singular »
	public static function singular($string)
	{
		return Str::singular($string);
	}



	// • === plural »
	public static function plural($string)
	{
		return Str::plural($string);
	}



	// • === words »
	public static function words($string, $noOfWords)
	{
		return Str::words($string, $noOfWords);
	}



	// • === firstWord »
	public static function firstWord($string)
	{
		return Str::words($string, 1);
	}



	// • === wordCount »
	public static function wordCount($string)
	{
		return str_word_count($string, 0, '');
	}
} //> end of class ~ StringX