<?php //*** BlendX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Data\Array;

use Groy\Xeno\Data\ArrayX;
use Groy\Xeno\Data\StringX;

/**
 * Blend a string or array into an existing array intelligently.
 * Handles strings, associative arrays, numeric arrays, and nested structures.
 * Converts strings to arrays on key collision, merges arrays, and ensures uniqueness.
 *
 * Simple cases:
 *   blend([], 'a')
 *     => ['a']
 *
 *   blend(['a'], 'b')
 *     => ['a', 'b']
 *
 *   blend([], ['x' => 1, 'y' => 2])
 *     => ['x' => 1, 'y' => 2]
 *
 * Key collision:
 *   blend(['name' => 'John'], ['name' => 'Jane'])
 *     => ['name' => ['John', 'Jane']]
 *
 *   blend(['mode' => 'dev'], ['mode' => 'dev'])
 *     => ['mode' => 'dev'] // no duplicate if value is the same
 *
 * Nested arrays:
 *   blend(['tags' => ['php']], ['tags' => ['laravel']])
 *     => ['tags' => ['php', 'laravel']]
 *
 * Numeric arrays:
 *   blend([1, 2], [2, 3])
 *     => [1, 2, 3] // uniqueness preserved
 *
 *   blend(['Log 1', 'Log 2'], 'Log 3')
 *     => ['Log 1', 'Log 2', 'Log 3']
 *
 * Mixed input:
 *   blend(['status' => 'new'], ['status' => ['processing', 'done']])
 *     => ['status' => ['new', 'processing', 'done']]
 *
 * Complex structure:
 *   blend(['user' => 'Alice'], ['user' => ['Bob', 'Charlie']])
 *     => ['user' => ['Alice', 'Bob', 'Charlie']]
 */


class BlendX
{
	// • === handle »
	public static function handle($array, $var)
	{
		if (!ArrayX::has($array)) {
			$array = [];
		}

		if (!empty($var)) {

			// ~ for empty $array
			if (empty($array)) {
				if (StringX::is($var)) {
					$array[] = $var;
				} elseif (is_array($var)) {
					$array = $var;
				}
			}


			// ~ for non-empty $array
			else {
				if (is_string($var)) {
					array_push($array, $var);
				} elseif (is_array($var)) {

					//...multi-dimensional array
					if (MultiX::is($var)) {
						foreach ($var as $key => $value) {

							//...if key does not exist in $array
							if (KeyX::isNot($array, $key)) {
								$array[$key] = $value;
							}

							//...if key exist in $array
							else {
								if (is_string($array[$key])) {
									$initialValue = $array[$key];
									$array[$key] = [];
									if (is_array($value)) {
										$array[$key] = array_merge([$initialValue], $value);
									} else {
										if ($initialValue != $value) {
											array_push($array[$key], $initialValue, $value);
										} else {
											$array[$key] = $value;
										}
									}
								} elseif (is_array($array[$key])) {
									$array[$key] = array_merge($array[$key], $value);
								}
							}
						}
					}

					//...not multi-dimensional numeric key array
					elseif (KeyX::numeric($var)) {
						foreach ($var as $value) {
							array_push($array, $value);
						}
						$array = ArrayX::unique($array);
						if (KeyX::numeric($var)) {
							$array = array_values($array);
						}
					}

					//...not multi-dimensional text key array
					else {
						foreach ($var as $key => $value) {
							//...when index exist in $array
							if (KeyX::is($array, $key)) {
								if (is_string($array[$key])) {
									$initialValue = $array[$key];
									$array[$key] = [];
									array_push($array[$key], $initialValue, $value);
								}
							}

							//...when index does not exist in $array
							else {
								$array[$key] = $value;
							}
						}
					}
				}
			}
		}

		return $array;
	}
} //> end of class ~ BlendX