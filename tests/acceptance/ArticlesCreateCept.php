<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('create and check check articles block');

$slug = $I->generateRandomSlug();

$I->havePageInDatabase([
	'post_name'    => $slug,
	'post_status'  => 'publish',
	'post_content' => $I->generateShortcode('shortcake_articles', [
		'article_heading'      => 'News',
		'read_more_text'       => 'More',
		'articles_description' => 'Articles Block description',
		'title_1'              => 'Column 1',
		'article_count'        => '1',
		'ignore_categories'    => 'false'
	])
]);

// Navigate to the newly created page
$I->amOnPage('/' . $slug);

// Check the Articles block
$I->see('News', 'h3.page-section-header');
$I->see('Articles Block description', 'p.page-section-description');
$I->see('More', 'button.btn-secondary');
$I->seeNumberOfElements('.article-list-item-headline', 1);

// Click more button
$I->click('button.btn-secondary');
$I->wait(2);
$I->seeNumberOfElements('.article-list-item-headline', 2);

