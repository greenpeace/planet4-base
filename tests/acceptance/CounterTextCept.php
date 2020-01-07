<?php
/**
 * @group frontend
 */

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'create and check counter block - Text only' );

$slug = $I->generateRandomSlug() . 'counter';

$I->havePageInDatabase(
	[
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_content' => $I->generateGutenberg(
			'wp:planet4-blocks/counter',
			[
				'title'       => 'Counter Block text only',
				'description' => 'Testing counter block',
				'completed'   => '7000',
				'target'      => '10000',
				'text'        => '%completed% of %target% only %remaining% left',
			]
		),
	]
);

// Navigate to the newly created page.
$I->amOnPage( '/' . $slug );

// Check title and description visible correctly.
$I->see( 'Counter Block text only', '.counter-style-plain > div > header > h2' );
$I->see( 'Testing counter block', '.counter-style-plain > div > .page-section-description p' );

// Check the text is rendered correctly.
$I->see( '7000', 'span.counter-target' );
$I->see( '7000 of 10000 only 3000 left', 'div.counter-text' );
