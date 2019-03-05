<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('check carousel header is rendered correctly');

// Start on the homepage
$I->amOnPage('/');

// Lets scroll to the top
$I->scrollTo('.page-template');

// Verify first slide
$I->see('Lorem Ipsum', 'h1');

// Click on the next icon and verify next slide
$I->click('.carousel-control-next-icon');
$I->see('Cras faucibus', 'h1');

// Click on the first indicator and verify first slide
$I->click('.carousel-indicators > li:first-child');
$I->see('Lorem Ipsum', 'h1');
