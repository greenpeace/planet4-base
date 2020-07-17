<?php

namespace Helper;

use Codeception\Module\WPWebDriver;

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
	 * Given a gutenberg block name as set of parameters, format it into a Gutenberg json comment
	 *
	 * e.g.
	 *
	 * ```
	 * $I->generateGutenberg('wp:planet4-blocks/articles', ['article_heading' => 'News', 'article_count' => '1']);
	 * # will give you <!-- wp:planet4-blocks/articles {"article_heading":"News","article_count":1,} /-->
	 * ```
	 *
	 * @param $name
	 * @param $data
	 * @return string
	 */
	function generateGutenberg($name, $data)
	{
		$result = '<!-- ' . $name . ' ';
		$result .= json_encode($data);
		$result .= ' /-->';
		return $result;
	}

	/**
	 * @param string $selector
	 * @return bool
	 */
	public function checkIfElementExists(string $selector): bool
	{
		$wd = $this->getModule('WPWebDriver');
		return $wd instanceof WPWebDriver
			&& !empty($wd->_findElements($selector));
	}
}
