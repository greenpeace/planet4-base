<?php
$I = new RegressionTester($scenario);
$I->wantTo('check Privacy and Cookies page');

$I->amOnPage('/privacy-and-cookies');

$I->unfixElements();

$I->dontSeeVisualChanges("PrivacyAndCookiesPage");
