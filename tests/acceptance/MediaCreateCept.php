<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('create and check media block');

$slug = $I->generateRandomSlug();

$I->havePageInDatabase([
	'post_name'    => $slug,
	'post_status'  => 'publish',
	'post_content' => $I->generateShortcode('shortcake_media_video', [
		'video_title' => 'Ocean Memories',
		'description' => 'Greenpeace presents the world\'s most northerly ice music concert',
		'youtube_id'  => 'https://www.youtube.com/watch?v=YvXiSGbfxUI'
	])
]);

// Navigate to the newly created page
$I->amOnPage('/' . $slug);

// Check the Tasks style
$I->see('Ocean Memories', 'h2.page-section-header');
$I->see('Greenpeace presents the world\'s most northerly ice music concert', 'div.page-section-description');
$I->seeElement('iframe');
