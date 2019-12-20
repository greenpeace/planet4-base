<?php

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'create and check a submenu block in all styles' );

$content = '
<!-- wp:heading {"level":2} -->
<h2>H2 no 1</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>This is the text of `H2 no 1`<br>
<br>This is quite a long text so that stuff below is definitely out of the viewport without scrolling</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>H2.H3 no 1</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<p>This is the text of `H2.H3 no 1`</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>H2.H3 no 2</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<p>This is the text of `H2.H3 no 2`</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>H2.H3.H4 no 1</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This is the text of `H2.H3.H4 no 1`</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>H2.H3.H4 no 2</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This is the text of `H2.H3.H4 no 2`</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>H2 no 2</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This is the text of `H2 no 2`<br>H2 no 2<br>H2 no 2</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>H2 no 3</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>This is the text of `H2 no 3`</p>
<!-- /wp:paragraph -->
';

foreach ( range( 1, 3 ) as $style ) {
	$submenuComment = $I->generateGutenberg( 'wp:planet4-blocks/submenu', [
		'levels'        => [
			[
				'heading' => 2,
				'link'    => true,
				'style'   => 'none',
			],
			[
				'heading' => 3,
				'link'    => true,
				'style'   => 'bullet',
			],
			[
				'heading' => 4,
				'link'    => true,
				'style'   => 'number',
			]
		],
		'submenu_style' => $style,
		'title'         => 'Submenu block title',
	] );
	$slug = $I->generateRandomSlug();

	$I->havePageInDatabase( [
		'post_name'    => $slug,
		'post_status'  => 'publish',
		'post_content' => $submenuComment . $content
	] );

	// Navigate to the newly created page
	$I->amOnPage( '/' . $slug );

	// Check the block title
	$I->see( 'Submenu block title', '.submenu-block h2' );

	// Check the submenu links for 3 levels and their corresponding list styles.
	$I->see( 'H2 no 1', 'li.list-style-none a[href=\#h2-no-1]' );
	$I->see( 'H2.H3 no 2', 'li.list-style-bullet a[href=\#h2-h3-no-2]' );
	$I->see( 'H2.H3.H4 no 1', 'li.list-style-number a[href=\#h2-h3-h4-no-1]' );

	$I->scrollTo( 'body' );

	$scrollAtTop = $I->executeJS( 'return window.pageYOffset' );

	$I->click( 'H2.H3.H4 no 1' );
	$I->wait( 2 );
	$scrollAfterMenuNavigate = $I->executeJS( 'return window.pageYOffset' );
	// For now only test if any scroll happened that is great enough, as there is no straightforward way to test if the
	// element is in the viewport.
	$I->assertGreaterThan( $scrollAtTop + 800, $scrollAfterMenuNavigate );
}
