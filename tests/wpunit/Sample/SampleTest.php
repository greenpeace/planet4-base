<?php
namespace Sample;

class SampleTest extends \Codeception\TestCase\WPTestCase
{

    public function setUp()
    {
        // before
        parent::setUp();

        // your set up methods here
    }

    public function tearDown()
    {
        // your tear down methods here

        // then
        parent::tearDown();
    }

    // tests
	public function testMe() {
		$active_plugins = get_option( 'active_plugins', array() );
		$languages      = apply_filters( 'wpml_active_languages', null, 'orderby=id&order=desc' );

		$icl = function_exists( 'icl_object_id' );
		codecept_debug( $active_plugins );
		codecept_debug( var_export( $icl, true ) );
		codecept_debug( var_export( $languages, true ) );


		$issue_cat_id = $this->factory->category->create(
			[
				'name'        => 'Issues',
				'slug'        => 'issues',
				'description' => 'Issues we work on',
			]
		);

		$issues_cat = get_category_by_slug( 'issues' );
		$this->factory->category->create(
			[
				'name'        => 'Nature',
				'slug'        => 'nature',
				'parent'      => $issues_cat->term_id,
				'description' => 'Focusing on great global forests and oceans we aim to preserve,
								  protect and restore the most valuable
								  ecosystems for the climate and for biodiversity.',
			]
		);

		$post_with_category_tag_custom_term = [
			'post_type'     => 'post',
			'post_title'    => 'The name of the place is Babylon',
			'post_name'     => 'test-social-url',
			'post_content'  => 'test content',
			'post_category' => [
				get_category_by_slug( 'nature' )->term_id,
			],
			'tags_input'    => [
				'arcticsunrise',
			],
			'tax_input'     => [
				'p4-page-type' => [ 'story' ],
			],
		];

		$posts = $this->factory->post->create_many( 10, $post_with_category_tag_custom_term );

		// Get the ID of the nature category.
		$category_id = get_cat_ID( 'Nature' );

		$permalink = get_category_link( $category_id );
		$this->go_to( $permalink );

		$this->assertFalse( is_404() );
		$this->assertTrue( is_category() );
	}

}
