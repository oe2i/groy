<?php //*** InputX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Input;

use Groy\Xeno\Data\StringX;
use Groy\Xeno\Data\JsonX;
use Groy\Xeno\Data\ArrayX;

class InputX
{
	// • === value » form field input value
	public static function value($field, $method = 'request')
	{
		if ($method === 'request') {
			$value = old($field);
		}

		if (!$value) {
			switch ($method) {
				case 'post':
					$value = $_POST[$field] ?? null;
					break;
				case 'get':
					$value = $_GET[$field] ?? null;
					break;
				case 'request':
				default:
					$value = $_REQUEST[$field] ?? null;
					break;
			}
		}
	}




	// • === clean »
	public function clean($input)
	{
		// TODO: improve this code
		if (is_array($input)) {
			foreach ($input as $field => $value) {
				if (empty($value)) {
					unset($input[$field]);
				}
			}
		}

		return $input;
	}




	// • === id » is input an ID?
	public static function id($input)
	{
		return (is_numeric($input) && $input > 0);
	}




	// • === puid » is input an PUID?
	public static function puid($input, $length = 10)
	{
		return (StringX::is($input) && strlen($input) === $length);
	}




	// • === tuid » is input an TUID?
	public static function tuid($input, $length = 70)
	{
		return (StringX::is($input) && strlen($input) === $length);
	}





	// • === jsonToArray »
	public static function jsonToArray($json, $keyPrefix = null)
	{
		$array = JsonX::toArray($json);
		if ($array && $keyPrefix) {
			return ArrayX::key()->prefix($array, $keyPrefix);
		}
		return $array;
	}
































	// • ==== create → make data ready for insert » array
	public static function createData(array $input = null)
	{
		// TODO: make input safe for insert
		if (!isset($input['oauthor'])) {
			$user = Auth::user();
			if ($user && !empty($user->puid)) {
				$input['oauthor'] = $user->puid;
			}
		}
		$input['guid'] = $input['guid'] ?? RandomX::guid(12);
		$input['puid'] = $input['puid'] ?? RandomX::puid(20);
		$input['suid'] = $input['suid'] ?? RandomX::suid(40);
		$input['tuid'] = $input['tuid'] ?? RandomX::tuid(70);
		$input['oauthor'] = $input['oauthor'] ?? null;
		$input = ArrayX::stripKey($input, '_token');
		$input = ArrayX::stripEmptyKey($input);
		return $input;
	}



	// ◇ === extractParam :: ... »
	public static function extractParam(array &$param, string $field, array &$input = [], $swapKey = null)
	{
		if (isset($param[$field])) {
			if (is_array($input)) {
				if (!is_null($swapKey)) {
					$input[$swapKey] = $param[$field];
				} else {
					$input[$field] = $param[$field];
				}
			}
			unset($param[$field]);
		}
		return $input;
	}





	// ◇ === paramToJson • ... » boolean
	public static function paramToJson(array &$param, string $column, array &$input = [])
	{
		$input = ArrayX::stripEmptyKey($input);
		if (!empty($input)) {
			if (empty($param[$column])) {
				$param[$column] = ArrayX::toJSON($input);
			} elseif (!empty($param[$column])) {
				// TODO: check if its JSON and convert to Array
				if (is_array($param[$column])) {
				}
			}
		}
	}


	// • === toUnit → ... » string
	public static function toUnit($quantity, $unit, $tag = null)
	{
		$units = self::unitOptions();
		if (!empty($units) && is_array($units) && ArrayX::isKey($units, $unit)) {
			$unit = $units[$unit];
		}

		$quantityIs = number_format($quantity);
		if ($quantity > 1) {
			$unitIs = ucfirst(Str::plural($unit));
		} else {
			$unitIs = ucfirst($unit);
		}

		if (!empty($tag)) {
			return $quantityIs . ' <' . $tag . '>' . $unitIs . '</' . $tag . '>';
		}
		return $quantityIs . ' ' . $unitIs;
	}





	// • === asUnit → ... » string
	public static function asUnit($unit, $quantity = 1)
	{
		if ($unit === 'MENDAY') {
			$unit = 'MEN-DAYS';
		}
		return $unit;
	}

} //> end of class ~ InputX