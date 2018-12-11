<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check home page');

$I->amOnPage('/');

$I->see('People Power', 'h2');
$I->see('Change the world', 'h2');

$lines = explode("\n", $I->grabPageSource());

// check we have no php warnings

foreach ($lines as $line) {
	$I->assertNotContains('<b>Warning</b>:', $line);
}

$I->assertNotContains('<b>Warning</b>:', $I->grabPageSource());
