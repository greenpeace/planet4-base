<?php
$I = new RegressionTester($scenario);
$I->wantTo('check act page');

$I->amOnPage('/act');

$I->unfixElements();

$I->dontSeeVisualChanges("ActPage");
