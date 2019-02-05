<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('check two columns can be created');

$I->loginAsAdminCached();

$I->see('Welcome to WordPress!');