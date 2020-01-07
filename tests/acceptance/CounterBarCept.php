<?php
/**
 * @group frontend
 */

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'create and check counter block - Progress Bar' );

$slug = $I->generateRandomSlug() . 'counter';

$I->havePageInDatabase(
	[
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_content' => $I->generateGutenberg(
			'wp:planet4-blocks/counter',
			[
				'title'       => 'Counter Block Progress Bar',
				'description' => 'Testing counter block',
				'style'       => 'bar',
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
$I->see( 'Counter Block Progress Bar', '.counter-style-bar > div > header > h2' );
$I->see( 'Testing counter block', '.counter-style-bar > div > .page-section-description p' );

// Check progress bar element visible on page.
$I->seeElement( 'div.progress-bar' );

// Check progress bar values.
$progress_bar_value = $I->grabAttributeFrom( 'div.progress-bar', 'style' );
$I->assertEquals( 'width: calc(70% + 20px);', $progress_bar_value );

// Check the text is rendered correctly.
$I->see( '7000', 'span.counter-target' );
$I->see( '7000 of 10000 only 3000 left', 'div.counter-text' );
