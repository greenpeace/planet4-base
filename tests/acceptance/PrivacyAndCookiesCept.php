<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check Privacy And Cookies page');

$I->amOnPage('/privacy-and-cookies');

// Ensure the submenu block is visible
$I->seeElement('.submenu-block');

// I see the cookie notice
$I->seeElement('.cookie-notice');

// Scroll down the page
$I->scrollTo('.cookies-block');

$I->wait(1);

// Ensure back to top arrow is visible
$I->seeElement('.back-top');

// Click on a cookie block control to hide the cookie notice
$I->click('.cookies-block .custom-control');

$I->wait(1);

// Ensure the submenu block is visible
$I->dontSeeElement('.cookie-notice');
