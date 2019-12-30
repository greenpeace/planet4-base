<?php
/**
 * @group frontend
 */

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'create and check counter block - Progress bar inside EN Form' );

$slug = $I->generateRandomSlug() . 'counter';

$counter_block = $I->generateGutenberg(
	'wp:planet4-blocks/counter',
	[
		'title'       => 'Counter Block Progress bar inside EN Form',
		'description' => 'Testing counter block',
		'style'       => 'en-forms-bar',
		'completed'   => '7000',
		'target'      => '10000',
		'text'        => '%completed% of %target% only %remaining% left',
	]
);

$en_block = $I->generateGutenberg(
	'wp:planet4-blocks/enform',
	[
		'en_page_id'                    => 0,
		'en_form_style'                 => 'side-style',
		'title'                         => 'EN form',
		'description'                   => 'EN form test description',
		'content_title'                 => 'EN Form content title',
		'content_title_size'            => 'h1',
		'content_description'           => 'EN Form content description',
		'button_text'                   => 'Sign up now!',
		'text_below_button'             => 'sample text below button',
		'thankyou_title'                => 'Thank you title',
		'thankyou_subtitle'             => 'Thank you subtitle',
		'thankyou_social_media_message' => 'Thank you social media message',
		'en_form_id'                    => 0,
	]
);

$I->havePageInDatabase(
	[
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_content' => $counter_block . $en_block,
	]
);

// Navigate to the newly created page.
$I->amOnPage( '/' . $slug );

// Check title and description visible correctly.
$I->see( 'Counter Block Progress bar inside EN Form', '.counter-style-en-forms-bar > div > header > h2' );
$I->see( 'Testing counter block', '.counter-style-en-forms-bar > div > .page-section-description p' );

// Check progress dial element visible on page inside EN form.
$I->seeElement( '#enform-content > div > div > .counter-style-en-forms-bar  > .content-counter > div > .progress-bar' );

// Check the text is rendered correctly.
$I->see( '7000', 'span.counter-target' );
$I->see( '7000 of 10000 only 3000 left', 'div.counter-text' );

// EN form visibility check.
$I->see( 'EN form', '#enform-content > div > h2' );
$I->see( 'EN form test description', '#enform-content .form-description p' );
$I->see( 'EN Form content title', '.form-caption h1' );
$I->see( 'EN Form content description', '.form-caption p' );
$I->see( 'sample text below button', '.enform-legal p' );
$I->see( 'Sign up now!', 'button.btn-primary' );
