<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check About Us page');

$I->amOnPage('/about-us-2');

$I->see('Who we are', 'h1');

// TODO: This is empty:
$I->scrollTo('.split-three-column');

// TODO: This has broken images, and only three columns...
$I->scrollTo('section.four-column');

$I->scrollTo('.media-block');

$I->seeElement('.media-block iframe');

// TODO: Test happy point.
$I->scrollTo('#happy-point');
