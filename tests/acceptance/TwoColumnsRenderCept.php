<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('check two columns are rendered correctly');

$slug = $I->generateRandomSlug();

$I->havePageInDatabase([
	'post_name' => $slug,
	'post_status' => 'publish',
	'post_content' => $I->generateShortcode('shortcake_two_columns', [
		'title_1' 		=> 'column one title',
		'description_1' => 'column one description',
		'button_text_1' => 'column one button',
		'button_link_1' => 'http://buttonone.com',
		'title_2' 		=> 'column two title',
		'description_2' => 'column two description',
		'button_text_2' => 'column two button',
		'button_link_2' => 'http://buttontwo.com'
	])
]);

$I->amOnPage('/' . $slug);

$I->see('column one title', '.col-lg-5 h2');
$I->see('column one description', '.col-lg-5 p');
$I->see('column one button', Locator::href('http://buttonone.com'));

$I->see('column two title', '.col-lg-5 h2');
$I->see('column two description', '.col-lg-5 p');
$I->see('column two button', Locator::href('http://buttontwo.com'));
