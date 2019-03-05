<?php
$I = new AcceptanceTester($scenario);

$I->wantTo('check search works');

$I->amOnPage('/');

// Search for the term "climate"
$I->submitForm('#search_form', ['s' => 'climate']);

// We get some results ...
$I->see('for \'climate\'', 'h2');

// ... and at least one #Climate tag to show up
$I->see('#Climate', '.search-result-item-tag');

// .. with a link to the #Climate tag page
$I->seeElement('.tag', ['href' => 'http://www.planet4.test/tag/climate/']);
