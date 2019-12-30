<?php
/**
 * @group frontend
 */

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'create and check counter block - Progress Dial' );

$slug = $I->generateRandomSlug() . 'counter';

$I->havePageInDatabase(
	[
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_content' => $I->generateGutenberg(
			'wp:planet4-blocks/counter',
			[
				'title'       => 'Counter Block Progress Dial',
				'description' => 'Testing counter block',
				'style'       => 'arc',
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
$I->see( 'Counter Block Progress Dial', '.counter-style-arc > div > header > h2' );
$I->see( 'Testing counter block', '.counter-style-arc > div > .page-section-description p' );

// Check progress dial element visible on page.
$I->seeElement( 'div.content-counter svg.progress-arc' );
$I->canSeeElement(
	'div.content-counter svg.progress-arc path.foreground',
	[
		'stroke-dashoffset' => '9.45',
		'stroke-dasharray'  => '31.5',
	]
);

// Check the text is rendered correctly.
$I->see( '7000', 'span.counter-target' );
$I->see( '7000 of 10000 only 3000 left', 'div.counter-text' );
