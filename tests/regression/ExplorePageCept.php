<?php
$I = new RegressionTester($scenario);
$I->wantTo('check explore page');

$I->amOnPage('/explore');

$I->unfixElements();

$I->dontSeeVisualChanges("ExplorePage");
