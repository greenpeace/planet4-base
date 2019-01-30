<?php
$I = new RegressionTester($scenario);
$I->wantTo('check about us page');

$I->amOnPage('/about-us-2');

$I->unfixElements();

$I->dontSeeVisualChanges("AboutUsPage");
