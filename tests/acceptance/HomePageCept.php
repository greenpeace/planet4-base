<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check home page');

$I->amOnPage('/');

$I->see('People Power', 'h2');
$I->see('Change the world', 'h2');

// the copyright notice appears on the page
$I->seeInSource($I->getP4Option('copyright_line1'));

// check we have no php warnings on the page
$I->dontSeeInSource('<b>Warning</b>:');
