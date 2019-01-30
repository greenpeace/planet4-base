<?php
$I = new RegressionTester($scenario);
$I->wantTo('check copyright page');

$I->amOnPage('/copyright');

$I->unfixElements();

$I->dontSeeVisualChanges("CopyrightPage");
