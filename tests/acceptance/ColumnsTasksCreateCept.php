<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('create and check columns block tasks style');

$slug = $I->generateRandomSlug();

$I->havePageInDatabase([
	'post_name'    => $slug,
	'post_status'  => 'publish',
	'post_content' => $I->generateShortcode('shortcake_columns', [
		'columns_block_style' => 'tasks',
		'columns_title'       => 'Tasks Columns',
		'columns_description' => 'Columns Block description',
		'title_1'             => 'Column 1',
		'description_1'       => 'Column 1 description',
		'attachment_1'        => 16,
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

// Check the Tasks style
$I->see('Tasks Columns', 'h3');
$I->see('Columns Block description', 'p');
$I->see('Column 1', '.step-info h5');
$I->see('Column 1 description', '.step-info p');
$I->seeElement('.steps-action img');
$I->see('Explore', '.steps-action a.btn-secondary');
