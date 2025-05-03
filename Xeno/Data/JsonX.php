<?php //*** JsonX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data;

class JsonX
{
	// • === is »
	public static function is($input)
	{
		if (!empty($input)) {
			json_decode($input);
			$o = (json_last_error() === JSON_ERROR_NONE);
			if ($o === true || $o === 1) {
				return true;
			}
		}
		return false;
	}




	// • === handler »
	public static function handler($data, $input, ?array $report = null)
	{
		if (!$report) {
			$report = [
				'code' => json_last_error(),
				'message' => json_last_error_msg(),
				'type' => gettype($input)
			];
		}

		// TODO: check and improve the code
		if ($report['code'] === JSON_ERROR_NONE) {
			return $data;
		} elseif (!empty($report['code'])) {
			return ['error' => $report, 'input' => $input];
		}
		return false;
	}




	// • === encode »
	public static function encode($input, $flag = 0)
	{
		if (!empty($input)) {
			$data = json_encode($input, $flag);
			return self::handler($data, $input);
		}
		return false;
	}




	// • === decode »
	public static function decode($json, $as = 'object')
	{
		if (!empty($json)) {

			if (is_array($json)) {
				$json = self::encode($json);
			}

			// ~ convert json string to Array
			if ($as === 'array') {
				$data = json_decode($json, true);
			}

			// ~ convert json string to Object
			elseif ($as === 'object') {
				$data = json_decode($json);
			}

			return self::handler($data, $json);
		}
		return false;
	}




	// • === toArray » decode json string to array
	public static function toArray($json)
	{
		return self::decode($json, 'array');
	}




	// • === toObject » decode json string to object
	public static function toObject($json)
	{
		return self::decode($json, 'object');
	}




	// • === pretty »
	public static function pretty($json)
	{
		return self::encode($json, JSON_PRETTY_PRINT);
	}




	// • === print »
	public static function print($json)
	{
		if (self::is($json)) {
			header('Content-Type: application/json');
			echo $json;
			exit;
		}
	}
}//> end of class ~ JsonX