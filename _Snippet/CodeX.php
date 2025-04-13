<?php

	// • ==== hasResult → handle checks for collection - model » boolean
	function hasResult($result): bool
	{
		if (is_numeric($result) && $result > 0) {
			return true;
		}

		// TODO: check if it is collection and has result

		return filled($result);
	}


		// • === caller → report class/function unavailable »
		function caller($caller, $type, &$file = null)
		{
			if ($type === 'CLASS' && !class_exists($caller) || $type === 'FUNCTION' && !function_exists($caller)) {
				return self::oversight($caller, ucfirst(strtolower($type)) . ' Unavailable!', $file);
			}
			return true;
		}


		// • === closure → ... »
		function closure($closure)
		{
			$reflection = new \ReflectionFunction($closure);
			return $reflection->getName();
		}