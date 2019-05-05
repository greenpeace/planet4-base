<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('create and check take action boxout block');

$slug = $I->generateRandomSlug();

$I->havePageInDatabase([
	'post_name'    => $slug,
	'post_status'  => 'publish',
	'post_content' => $I->generateShortcode('shortcake_take_action_boxout', [
		'take_action_page' => '28'
	])
]);

// Navigate to the newly created page
$I->amOnPage('/' . $slug);

// Check the Subheader header block
$I->see('#Climate', '.cover-card .cover-card-tag');
$I->see('Vestibulum leo libero', '.cover-card h2.cover-card-heading');
$I->see('Get Involved', '.cover-card a.btn-action');
