<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check Sitemap page');

$I->amOnPage('/sitemap');

// Ensure the sitemap template is being used
$I->seeElement('.page-sitemap');

// Ensure all types of sitemap entries are there

// Act
$I->see('Consectetur adipiscing elit', 'a');

// Explore
$I->see('Energy', 'a');
$I->see('#Coal', 'a');
$I->see('Nature', 'a');
$I->see('#Forests', 'a');

// About
$I->see('Community Policy', 'a');

// Articles
$I->see('Press Release', 'a');
$I->see('Publication', 'a');
$I->see('Story', 'a');
