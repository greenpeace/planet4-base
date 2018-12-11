<?php

class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

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

	public function fillFields($data)
	{
		$I = $this;
		foreach ($data as $key => $value) {
			$I->fillField($key, $value);
		}
	}

	public function loginAsAdminCached()
	{
		$I = $this;
		$I->amOnPage('/');
		if ($I->loadSessionSnapshot('login/admin')) {
			return;
		}
		$I->loginAsAdmin();
		$I->saveSessionSnapshot('login/admin');
	}

}
