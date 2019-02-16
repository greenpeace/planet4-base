<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check home page');

$I->amOnPage('/');

$I->see('People Power', 'h3');
$I->see('Change the world', 'h3');

// Ensure the country dropdown opens
$I->click('.country-dropdown-toggle');

$I->seeElement('.country-list.open');

