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