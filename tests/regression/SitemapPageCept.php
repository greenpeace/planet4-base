<?php
$I = new RegressionTester($scenario);
$I->wantTo('check sitemap page');

$I->amOnPage('/sitemap');

$I->unfixElements();

$I->dontSeeVisualChanges("SitemapPage");
