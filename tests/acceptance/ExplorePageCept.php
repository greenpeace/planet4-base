<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check Explore page');

$I->amOnPage('/explore');

$I->see('Justice for people and planet', 'h1');

$I->scrollTo('.split-two-column.block-wide');

$I->see('Energy', 'a');
$I->see('#renewables', '.split-two-column-item-tag');

$I->scrollTo('.article-listing-intro');

$I->see('Duis posuere', 'a');

$I->scrollTo('#happy-point');

// TODO: Add happy-point test here.

$I->click('#header .btn-donate');

$I->wait(.5);

$I->see('Justice for people and planet', 'h1');
