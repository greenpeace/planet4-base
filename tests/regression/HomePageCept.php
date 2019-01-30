<?php
$I = new RegressionTester($scenario);
$I->wantTo('check home page');

$I->amOnPage('/');

$I->unfixElements();

$I->dontSeeVisualChanges("HomePage");
