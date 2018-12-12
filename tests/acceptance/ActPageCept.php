<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check act page');

$I->amOnPage('/act');

$I->seeElement('.page-header');
$I->seeElement('.page-header-title');

$I->seeElement('.covers-block');
$I->seeElement('.cover-card');

$I->see('#Consumption', '.cover-card-tag');
$I->see('#renewables', '.cover-card-tag');
$I->see('#Climate', '.cover-card-tag');

$I->seeElement('.site-footer');
$I->seeElement('.footer-social-media');
$I->seeElement('.footer-links');
$I->seeElement('.footer-links-secondary');
