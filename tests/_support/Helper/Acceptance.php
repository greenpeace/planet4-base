<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{

	/**
	 * Generate a random string of a given length from a given set of characters
	 *
	 * @param int $length
	 * @param string $characters
	 * @return string
	 */
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

	/**
	 * Generate a random string suitable to be used as a WordPress slug
	 *
	 * @param int $length
	 * @return string
	 */
	function generateRandomSlug($length = 10)
	{
		return $this->generateRandomString($length, 'abcdefghijklmnopqrstuvwxyz');
	}

	/**
	 * Given a shortcode name as set of parameters, format it into WordPress shortcode syntax
	 *
	 * e.g.
	 *
	 * ```
	 * $I->generateShortcode('myshortcode_name', ['with' => 'params', 'like' => 'this']);
	 * # will give you [myshortcode_name with="params" like="this" /]
	 * ```
	 *
	 * @param $name
	 * @param $data
	 * @return string
	 */
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
