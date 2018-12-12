<?php

class AcceptanceTester extends \Codeception\Actor
{
	use _generated\AcceptanceTesterActions;

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

	public function getP4Option($name)
	{
		$I = $this;
		$value = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => 'planet4_options']);
		return unserialize($value)[$name];
	}

}
