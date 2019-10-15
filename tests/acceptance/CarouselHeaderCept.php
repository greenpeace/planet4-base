<?php
use \Codeception\Util\Locator;

/**
 * @group frontend
 */

$I = new AcceptanceTester($scenario);

$I->wantTo('create and check carousel header block');

$slug = $I->generateRandomSlug();

$I->havePageInDatabase([
	'post_name'    => $slug,
	'post_status'  => 'publish',
	'post_content' => $I->generateShortcode('shortcake_carousel_header', [
		'block_style'   => 'full-width-classic',
		'image_1'       => '64',
		'header_1'      => 'Header 1',
		'description_1' => 'Image 1 description',
		'link_text_1'   => 'Act',
		'link_url_1'    => '/act/',
		'image_2'       => '65',
		'header_2'      => 'Header 2',
		'description_2' => 'Image 2 description',
		'link_text_2'   => 'Explore',
		'link_url_2'    => '/explore/'
	])
]);

// Navigate to the newly created page
$I->amOnPage('/' . $slug);

// Check the Carousel header block
$I->see('Header 1', '.carousel-captions-wrapper > h1');
$I->see('Image 1 description', '.carousel-captions-wrapper > p');
$I->see('Act', 'a.btn-primary');
$I->scrollTo('.carousel-header_full-width-classic');
$I->seeElement('.carousel-control-prev-icon');
$I->seeElement('.carousel-control-next-icon');
$I->seeNumberOfElements('.carousel-indicators > li', 2);

// Click next button
$I->click('.carousel-control-next');
$I->waitForElementVisible( '//div[@class="carousel-inner"]/div[contains(@class, "carousel-item") and position()=2]', 10 ); // secs
$I->see('Header 2', '.carousel-captions-wrapper > h1');

// Click first indicator
$I->click('.carousel-indicators > li:first-child');
$I->waitForElementVisible( '//div[@class="carousel-inner"]/div[contains(@class, "carousel-item") and position()=1]', 10 ); // secs
$I->see('Header 1', '.carousel-captions-wrapper > h1');
$I->scrollTo('.page-template');
