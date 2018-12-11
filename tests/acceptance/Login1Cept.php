<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('login once');

$I->loginAsAdminCached();
