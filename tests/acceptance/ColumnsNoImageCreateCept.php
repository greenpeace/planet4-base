<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('create and check columns block no image style');

$slug = $I->generateRandomSlug();

$I->havePageInDatabase([
	'post_name'    => $slug,
	'post_status'  => 'publish',
	'post_content' => $I->generateShortcode('shortcake_columns', [
		'columns_block_style' => 'no_image',
		'columns_title'       => 'No Image Columns',
		'columns_description' => 'Columns Block description',
		'title_1'             => 'Column 1',
		'description_1'       => 'Column 1 description',
		'link_1'              => '/act/',
		'cta_text_1'          => 'Act',
		'title_2'             => 'Column 2',
		'description_2'       => 'Column 2 description',
		'link_2'              => '/explore/',
		'cta_text_2'          => 'Explore'
	])
]);

// Navigate to the newly created page
$I->amOnPage('/' . $slug);

// Check the No Image style
$I->see('No Image Columns', 'h2');
$I->see('Columns Block description', 'p');
$I->see('Column 1', 'h3 > a');
$I->see('Column 1 description', 'p');
$I->see('Explore', 'a.btn-secondary');
