<?php
class InputX
{
	// ◈ === email »
	public static function email($var)
	{
		return filter_var($var, FILTER_VALIDATE_EMAIL) !== false;
	}



	// ◈ === phone »
	public static function phone($var, $country = 'NGA'): bool
	{
		if (!is_numeric($var) && !is_numeric(substr($var, 1))) {
			return false;
		}

		if ($country === 'NGA') {
			$validPatterns = [
				'0' => 11,          // ~ 09026636728
				'234' => 13,        // ~ 2349026636728
				'+234' => 14        // ~ +2349026636728
			];

			foreach ($validPatterns as $prefix => $length) {
				if (str_starts_with($var, $prefix) && strlen($var) === $length) {
					return true;
				}
			}
		}

		return false;
	}

}