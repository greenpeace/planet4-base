<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('check two columns can be created');

$I->loginAsAdminCached();

$I->amOnPage('/wp-admin/post-new.php?post_type=page');
$I->click('Add Page Element');
$I->click('[data-shortcode="shortcake_two_columns"]');

$fields = [
	'title_1' => 'a',
	'description_1' => 'b',
	'button_text_1' => 'c',
	'button_link_1' => 'd',
	'title_2' => 'e',
	'description_2' => 'f',
	'button_text_2' => 'g',
	'button_link_2' => 'h',
];

$I->fillFields($fields);

$I->click('Insert Element');

$I->click('Publish');

$content = $I->grabFromDatabase('wp_posts', 'post_content', ['ID' => $I->grabValueFrom('post_ID')]);

$I->assertEquals($content, $I->generateShortcode('shortcake_two_columns', $fields));
