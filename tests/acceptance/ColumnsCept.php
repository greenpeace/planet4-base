<?php
use \Codeception\Util\Locator;

/**
 * @group frontend
 */

$I = new AcceptanceTester($scenario);

$I->wantTo('check all columns block styles');

// Start on the homepage
$I->amOnPage('/');

// Check the No Image style
$I->see('People Power', 'h3 > a');
$I->see('Discover our stories', 'a.btn-secondary');

// Check the Icons style
$I->see('Get to know our organisation', 'h2');
$I->see('History', 'h3');
$I->seeElement('//img[contains(@src, "organisation")]');

// Switch to an action page
$I->amOnPage('act/consectetur-adipiscing-elit/');

// Check the Tasks style
$I->see('1', '.step-number-inner');
$I->see('Dance for the Congo', 'h5');
$I->see('Share your video', 'a.btn-secondary');
