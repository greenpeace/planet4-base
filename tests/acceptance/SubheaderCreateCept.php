<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('create and check subheader block');

$slug = $I->generateRandomSlug();

$I->havePageInDatabase([
	'post_name'    => $slug,
	'post_status'  => 'publish',
	'post_content' => $I->generateShortcode('shortcake_subheader', [
		'title'       => 'Subheader',
		'description' => 'Subheader description'
	])
]);

// Navigate to the newly created page
$I->amOnPage('/' . $slug);

// Check the Subheader header block
$I->see('Subheader', '.subheader h2');
$I->see('Subheader description', '.subheader p');
