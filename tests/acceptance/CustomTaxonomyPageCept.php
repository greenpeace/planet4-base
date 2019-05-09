<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check Custom Taxonomy page');

$I->amOnPage('/story');

$I->see('Story', 'h1');

$I->click('Lilian Reyes');

$I->amOnPage('/author/lreyes');

$I->see('Lilian Reyes', 'h1');
