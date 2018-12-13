<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{

	function generateRandomString(
		$length = 10,
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
	)
	{
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function generateRandomSlug($length = 10)
	{
		return $this->generateRandomString($length, 'abcdefghijklmnopqrstuvwxyz');
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
