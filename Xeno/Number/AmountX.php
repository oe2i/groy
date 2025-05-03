<?php //*** AmountX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Number;

use Illuminate\Support\Str;
use Illuminate\Support\Number;
use Groy\Xeno\Data\StringX;

class AmountX
{
	// • === spell »
	public static function spell($number)
	{
		// NOTE: it max out at 18 quadrillion (LARAVEL)
		$number = StringX::strip()->all($number, ',');
		if (StringX::in($number, '.')) {
			$number = (float) $number;
		} else {
			$number = (int) $number;
		}
		return Number::spell($number);
	}




	// • === kobo » format kobo in words for amount
	private static function kobo(&$amount)
	{
		$kobo = StringX::afterLast($amount, '.');
		if (!$kobo || $kobo === '0' || $kobo === '00' || empty($kobo)) {
			return false;
		}

		if (StringX::begin()->with($kobo, '0') && StringX::length($kobo) === 2) {
			$kobo = StringX::crop()->begin($kobo, '0');
		}

		$amount = StringX::beforeAs($amount, '.');
		return self::spell($kobo);
	}




	// • === hundred » format hundred in words for amount
	private static function hundred($word)
	{
		if (StringX::after(trim($word), 'hundred')) {
			$word = StringX::swap()->first($word, 'hundred', 'hundred and ');
		}
		return $word;
	}




	// • === comma » label amount based on number of commas
	private static function comma($numberOfComma)
	{
		$commas = [
			1 => 'thousand',
			2 => 'million',
			3 => 'billion',
			4 => 'trillion',
			5 => 'quadrillion',
			6 => 'quintillion',
			7 => 'sextillion',
		];

		if (isset($commas[$numberOfComma])) {
			return $commas[$numberOfComma];
		}

		return false;
	}




	// • === zero » remove zero amount from words
	private static function zero($words)
	{
		$zeros = [
			'zero sextillion',
			'zero quintillion',
			'zero quadrillion',
			'zero trillion',
			'zero billion',
			'zero million',
			'zero thousand',
		];

		foreach ($zeros as $zero) {
			if (StringX::contain($words, $zero)) {
				$before = StringX::before($words, $zero);
				$after = StringX::after($words, $zero);
				if ($after && StringX::begin()->with($after, ',')) {
					$after = StringX::crop()->begin($after, ',');
					$after = trim($after);
				}
				$words = self::zero($before . ' ' . $after);
			}
		}

		if (!empty($words)) {
			$words = trim($words);
			$words = StringX::crop()->text($words, 'zero');
			$words = StringX::crop()->text($words, ',');
		}

		return $words;
	}




	// • === spelling » amount as spelling
	private static function spelling($amount)
	{
		$words = self::spell($amount);
		if ($words) {
			$words = self::hundred($words);
		}
		return $words;
	}




	// • === nairaKobo » format amount from words as Naira & Kobo
	private static function nairaKobo($naira = null, $kobo = null, $zeroNaira = false)
	{
		if ($naira) {
			$naira = StringX::space()->single($naira);
			$naira = self::zero($naira);
		}

		if ($naira) {
			$naira = trim($naira);
			$naira = StringX::end()->ifNot($naira, ' naira');
			$naira = StringX::end()->ifNot($naira, 'naira');
		}
		if (!$zeroNaira) {
			$naira = StringX::strip()->all($naira, 'zero naira');
		}
		if (!empty($naira) && !empty($kobo)) {
			$naira = trim($naira);
			$naira = StringX::end()->ifNot($naira, ',');
			$naira .= ' ' . $kobo . ' kobo';
		} elseif (!empty($kobo)) {
			$naira = $kobo . ' kobo';
		}

		$naira = StringX::swap()->all($naira, ',,', ',');
		$naira = trim($naira);
		return StringX::crop()->end($naira, ',');
	}




	// • === pluralize »
	private static function pluralize($words, $singular, $plural = null)
	{
		if (StringX::in($words, $singular)) {
			$string = StringX::before($words, $singular);
			if (!empty($string)) {
				$string = trim($string);
			}

			if ($string === 'one') {
				return $words;
			}
			// elseif(StringX::end()->with($string, 'and one')){
			// 	return $words;
			// }

			if (!$plural) {
				$plural = Str::plural($singular);
			}

			$words = StringX::swap()->first($words, $singular, $plural);

		}
		return $words;
	}




	// • === words » amount in words [uses naira & kobo]
	public static function words($amount, $zeroNaira = false)
	{
		$kobo = self::kobo($amount);
		$comma = StringX::occurrence($amount, ',');

		if (empty($comma)) {
			$words[] = self::spelling($amount);
		} else {
			while ($comma > 0) {
				$number = StringX::before($amount, ',');
				$label = self::comma($comma);
				$spelling = self::spelling($number);
				if ($label) {
					$words[] = trim($spelling) . ' ' . $label;
				}
				$amount = trim(StringX::strip()->first($amount, $number . ','));
				$comma--;
			}

			if (!empty($amount)) {
				$words[] = self::spelling($amount);
			}
		}


		$naira = null;
		$count = count($words);

		if ($count === 1) {
			$naira = $words[0];
		} elseif ($count > 1) {
			$naira = '';
			foreach ($words as $word) {
				$naira .= $word . ', ';
			}
			$naira = StringX::strip()->last($naira, ',');
		}

		return self::nairaKobo($naira, $kobo, $zeroNaira);
	}




	// • === dollar »
	public static function dollar($amount, $zeroCent = false)
	{
		$words = self::words($amount, $zeroCent);
		if (!empty($words)) {
			$words = StringX::swap()->first($words, 'naira', 'dollar');
			$words = StringX::swap()->first($words, 'kobo', 'cent');
			$words = self::pluralize($words, 'dollar');
			$words = self::pluralize($words, 'cent');
		}
		return $words;
	}




	// • === euro »
	public static function euro($amount, $zeroCent = false)
	{
		$words = self::words($amount, $zeroCent);
		if (!empty($words)) {
			$words = StringX::swap()->first($words, 'naira', 'euro');
			$words = StringX::swap()->first($words, 'kobo', 'cent');
			$words = self::pluralize($words, 'euro');
			$words = self::pluralize($words, 'cent');
		}
		return $words;
	}




	// • === pound »
	public static function pound($amount, $zeroCent = false)
	{
		$words = self::words($amount, $zeroCent);
		if (!empty($words)) {
			$words = StringX::swap()->first($words, 'naira', 'pound');
			$words = StringX::swap()->first($words, 'kobo', 'penny');
			$words = self::pluralize($words, 'pound');
			$words = self::pluralize($words, 'penny', 'pence');
		}
		return $words;
	}
} //> end of class ~ AmountX