<?php

$I = new AcceptanceTester($scenario);

$I->wantTo('check static four columns are renders correctly');

// The home page has a shortcake_static_four_column
$I->amOnPage('/');

$I->seeNumberOfElements('.four-column-wrap.col-md-6', 4);
