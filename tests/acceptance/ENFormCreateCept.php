<?php
/**
 * @group engagingnetworks
 */

$I = new AcceptanceTester( $scenario );

// Read sample ENS API responses and cache them to avoid trying to do the actual calls during testing.
$json = file_get_contents( __DIR__ . '/../_support/plugins/engagingnetworks/ensapi_sample_responses.json' );
$data = json_decode( $json, true );

$cache_key = 'ens_supporter_fields_response';
$supporter = json_encode( $data['supporter'] );
$I->cli( 'cache set --allow-root ' . $cache_key . ' \'' . $supporter . '\' transient 600' );

$cache_key = 'ens_supporter_questions_response';
$questions = json_encode( $data['questions'] );
$I->cli( 'cache set --allow-root ' . $cache_key . ' \'' . $questions . '\' transient 600' );

// Start testing.
$I->wantTo( 'Check ENForm creation works' );

$I->loginAsAdminCached();

$I->amOnPage( '/wp-admin/post-new.php?post_type=p4en_form' );

$I->see( 'Add New EN Form', 'h1' );

$I->fillField( 'post_title', 'Acceptance Test - ENForm' );

$I->see( 'Form preview', 'span' );
$I->see( 'Selected Components', 'span' );
$I->see( 'Available Fields', 'span' );
$I->see( 'Available Questions', 'span' );
$I->see( 'Available Opt-ins', 'span' );

$I->click( 'button[data-name="Email address"]' );
$I->click( 'tr[data-en-name="Email address"] input[type="checkbox"]' );
$I->selectOption( 'tr:last-child .field-type-select', 'Text' );

$I->click( 'Publish' );

$I->see( 'Edit EN Form', 'h1' );

$I->seeElement(
	'tr',
	[
		'data-en-name' => 'Email address',
	]
);
