<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('create and check covers block content style');

$slug = $I->generateRandomSlug();

$I->havePageInDatabase([
	'post_name'    => $slug,
	'post_status'  => 'publish',
	'post_content' => $I->generateShortcode('shortcake_newcovers', [
		'cover_type'  => '3',
		'title'       => 'Content',
		'tags'        => '7',
		'description' => 'Description text',
		'covers_view' => '0'
	])
]);

// Navigate to the newly created page
$I->amOnPage('/' . $slug);

// Check the Covers block
$I->see('Content', 'h2.page-section-header');
$I->see('Description text', 'p.page-section-description');
$I->see('Duis posuere', 'h4');
$I->seeElement('.publication-date');
$I->seeElement('.four-column-content-symbol img');

