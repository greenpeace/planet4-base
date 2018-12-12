<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
	function generateRandomSlug($length = 10)
	{
		$characters = 'abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function generateShortcode($name, $data)
	{
		$result = '[' . $name . '';
		foreach ($data as $key => $value) {
			$result .= ' ' . $key . '="' . $value . '"';
		}
		$result .= ' /]';
		return $result;
	}

}
