
<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('create and check counter block');

$slug = $I->generateRandomSlug()."counter";

$I->havePageInDatabase([
	'post_name'     => $slug,
	'post_status'   => 'publish',
	'post_content'  => $I->generateGutenberg('wp:planet4-blocks/counter', [
		'title'       => 'Counter Test',
		'description' => 'Testing counter block',
		'style'       => 'bar',
		'completed'   => '7000',
		'target'      => '10000',
		'text'        => '%completed% of %target% only %remaining% left'
	])
]);

// Navigate to the newly created page
$I->amOnPage('/' . $slug);

// Check the text is rendered correctly
$I->see('7,000', 'span.counter-target');
$I->see('7,000 of 10,000 only 3,000 left', 'p.counter-text');
