<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check About Us page');

$I->amOnPage('/about-us-2');

$I->see('Who we are', 'h1');

$I->scrollTo('.split-three-column');

$I->see('Get to know our organisation', 'h2');

$I->scrollTo('.media-block');

$I->seeElement('.media-block iframe');

// TODO: Test happy point.
$I->scrollTo('#happy-point');
