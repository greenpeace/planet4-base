<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('login once');

$I->loginAsAdminCached();

$I->see('Welcome to WordPress!');
