<?php //*** RandomX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data;

use Groy\Xeno\Enum\Cases;
use Groy\Xeno\Number\NumberX;

class RandomX
{
	// • === length » randomize length
	public static function length($max = 100, $min = 1)
	{
		return mt_rand($min, $max);
	}




	// • === string » randomize string
	public static function string(string $string, int|string $length = 'auto')
	{
		$string = str_shuffle($string);
		if ($length === 'auto') {
			return $string;
		} elseif (is_numeric($length)) {
			$isLength = strlen($string);
			if ($length <= $isLength) {
				return substr($string, 0, $length);
			} else {
				$count = $length - $isLength;
				return $string . self::string($string, $count);
			}
		}
		return false;
	}




	// • === array » randomize array
	public static function array(array $array, int|string $length = 'auto')
	{
		shuffle($array);
		$string = '';
		foreach ($array as $value) {
			$string .= $value;
		}
		return self::string($string, $length);
	}




	// • === word »
	public static function word(array $words, $number = 1)
	{
		shuffle($words);
		$max = count($words);
		if ($max !== 0) {
			if ($number === 1) {
				return $words[mt_rand(0, $max - 1)];
			}
			return array_slice($words, 0, min($number, $max));
		}
		// throw new InvalidArgumentException("The words array cannot be empty.");
	}




	// • === create »
	public static function create(string|array $input, $length = 'auto')
	{
		if (!empty($input)) {
			if (is_array($input)) {
				return self::array($input, $length);
			} else {
				return self::string($input, $length);
			}
		}
		return false;
	}




	// • === numeric »
	public static function numeric(int|string $length = 4)
	{
		return self::create('1234567890', $length);
	}




	// • === alpha » alphabet
	public static function alpha($length = 4, $case = 'both')
	{
		if ($case === 'lower') {
			$alphabet = Cases::LOWERCASE->grab();
		} elseif ($case === 'upper') {
			$alphabet = Cases::UPPERCASE->grab();
		} else {
			$alphabet = Cases::BOTH->grab();
			shuffle($alphabet);
		}
		return self::create($alphabet, $length);
	}




	// • === lowercase »
	public static function lowercase(int|string $length = 4)
	{
		return self::alpha($length, 'lower');
	}




	// • === uppercase »
	public static function uppercase(int|string $length = 4)
	{
		return self::alpha($length, 'upper');
	}




	// • === alphanumeric »
	public static function alphanumeric(int|string $length = 4, Cases $case = Cases::BOTH)
	{
		$alpha = self::alpha($length, $case);
		$numeric = self::numeric($length);
		return self::create($alpha . $numeric, $length);
	}




	// • === char » special character
	public static function char($length = 1)
	{
		return self::create('(_=@#$[%{&*?)]!}', $length);
	}




	// • === generate »
	public static function generate()
	{
		return str_shuffle(
			mt_rand()
			. self::lowercase('auto')
			. self::numeric('auto')
			. self::uppercase('auto')
			. time()
		);
	}




	// • === pin »
	public static function pin(int $length = 5)
	{
		return self::numeric($length);
	}




	// • === id » [string, integer]
	public static function id(?int $length = null, bool $alphaNumeric = true)
	{
		$length = $length ?? self::length(8, 4);
		return $alphaNumeric ? self::alphanumeric($length) : self::numeric($length);
	}




	// • === serial »
	public static function serial()
	{
		return date('Ym') . self::alphanumeric(4, Cases::UPPERCASE) . self::uppercase(2);
	}




	// • === otp »
	public static function otp($length = 6)
	{
		return self::numeric($length);
	}




	// • === filename »
	public static function filename($extension = null, $length = 10, string|Cases $case = Cases::BOTH, ?string $prefix = null, ?string $surfix = null)
	{
		if ($case === 'numeric') {
			$filename = $prefix . self::numeric($length) . $surfix;
		} else {
			$filename = $prefix . self::alphanumeric($length, $case) . $surfix;
		}

		$filename .= !empty($extension) ? '.' . $extension : '';

		return $filename;
	}




	// • === username »
	public static function username($length = 'auto')
	{
		if ($length === 'auto') {
			$username = self::lowercase(8) . self::numeric(4);
		} else {
			$username = self::lowercase($length);
		}
		return $username;
	}




	// • === simple »
	public static function simple()
	{
		$alpha = chr(rand() > 0.5 ? rand(65, 90) : rand(97, 122));
		return $alpha . mt_rand(100, 999) . date('sdm') . mt_rand(10, 99) . self::alpha(3);
	}




	// • === ten »
	public static function ten(Cases $case = Cases::BOTH)
	{
		return self::numeric(8) . self::alpha(2, $case);
	}




	// • === ban » bank account number
	public static function ban()
	{
		return mt_rand(1000000000, 9999999999);
	}




	// • === puid »
	public static function puid($length = 10)
	{
		return substr(self::generate(), 0, $length);
	}




	// • === suid »
	public static function suid($length = 100)
	{
		return substr(self::generate(), 0, $length);
	}




	// • === guid »
	public static function guid($length = 12)
	{
		if ($length <= 10) {
			return self::numeric($length);
		}

		$length = $length - 10;
		if ($length <= 3) {
			return self::numeric(10) . self::uppercase($length);
		}

		$length = $length - 3;
		return self::uppercase(3) . self::numeric(10) . self::uppercase($length);
	}




	// • === tuid »
	public static function tuid($length = 70)
	{
		return substr(self::generate(), 0, $length);
	}




	// • === luid »
	public static function luid($length = 50)
	{
		return substr(self::generate(), 0, $length);
	}




	// • === token »
	public static function token($length = null)
	{
		if (!$length) {
			$length = self::length(30, 20);
		}
		return substr(self::generate(), 0, $length);
	}




	// • === key »
	public static function key($length = 20)
	{
		return substr(self::generate(), 0, $length);
	}




	// • === password »
	public static function password($length = 12)
	{
		if (NumberX::even($length)) {
			$A = self::length($length / 2);
		} else {
			$A = self::length(($length - 1) / 2);
		}
		$partA = substr(self::generate(), 0, $A);

		$B = self::length(2);
		$partB = self::create('(=_@#[{*)]}', $B);

		$lengthNow = $A + $B;
		if ($length > $lengthNow) {
			$length = $length - $lengthNow;
		}

		$partC = self::alphanumeric($length);
		return $partA . $partB . $partC;
	}




	// • === sequence » generate sequential number
	public static function sequence($last = null, $prefix = null)
	{
		if (!$prefix) {
			$prefix = date('Ym');
		}

		if (!empty($prefix)) {
			$prefix .= '-';
		}

		if (!$last) {
			$last = '000';
		} else {
			$last = StringX::afterAs($last, '-');
		}

		return $prefix . str_pad((int) $last + 1, 4, '0', STR_PAD_LEFT);
	}
} //> end of class ~ RandomX