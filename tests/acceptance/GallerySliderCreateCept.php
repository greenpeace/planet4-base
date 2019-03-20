
<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('create and check check gallery block slider style');

$slug = $I->generateRandomSlug();

$I->havePageInDatabase([
	'post_name'    => $slug,
	'post_status'  => 'publish',
	'post_content' => $I->generateShortcode('shortcake_gallery', [
		'gallery_block_style'       => '1',
		'gallery_block_title'       => 'Slider',
		'gallery_block_description' => 'Slider description',
		'multiple_image'            => '64,61'
	])
]);

// Navigate to the newly created page
$I->amOnPage('/' . $slug);

// Check the Gallery block
$I->see('Slider', 'h1');
$I->see('Slider description', 'p');
$I->scrollTo('.carousel-wrap');

// Click next button
$I->click('.carousel-control-next-icon');
$I->wait(1);
$I->see('solar power', '.carousel-caption p');

// Click first indicator
$I->click('.carousel-indicators > li:first-child');
$I->wait(1);
$I->see('Penguins', '.carousel-caption p');

// Check arrows and indicators
$I->seeNumberOfElements('.carousel-indicators > li', 2);
$I->seeElement('.carousel-control-prev-icon');
$I->seeElement('.carousel-control-next-icon');
$I->scrollTo('.page-template');

