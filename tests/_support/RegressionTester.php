<?php

use tad\WPBrowser\Generators\Date;

class RegressionTester extends \Codeception\Actor
{
	use _generated\RegressionTesterActions;

	/**
	 * Unfix some fixed elements to clean up the full page
	 * screenshots and avoid repeating them on scroll.
	 */
	public function unfixElements()
	{
		$I = $this;
		$I->executeJS('$("#header.top-navigation").attr("style", "position: absolute !important; top: 0 !important")');
		$I->executeJS('$(".cookie-notice").attr("style", "position: absolute !important; bottom: 0 !important")');
	}
}
