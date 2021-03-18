<?php
namespace Step\Acceptance\Admin;

/**
 * Gutenberg: steps to use Gutenberg editor
 */
class CampaignGeneratorSteps
{
	/**
	 * @var \AcceptanceTester;
	 */
	protected $tester;

	public function __construct(
		\AcceptanceTester $I
	) {
		$this->tester = $I;
	}

	/**
	 * @Then I see Analytics & Tracking section validation error message
	 */
	public function iSeeAnalyticsTrackingSectionValidationErrorMessage()
	{
		$I = $this->tester;
		$I->waitForText( 'Please check "Analytics & Tracking" section for required fields.', 5 );
		$I->see( 'Global Project is a required field' );
	}

	/**
	 * @Then I select global project :arg1
	 */
	public function iSelectGlobalProject( $arg1 )
	{
		$I = $this->tester;
		$I->click( '//div[contains(@class, "editor-post-publish-panel__header-cancel-button")]/button[contains(text(), "Cancel")]' );
		$I->click( '//button[@data-label="Campaign"]' );
		$I->appendField( '#p4_campaign_name', $arg1 );
	}

	/**
	 * @Then the campaign is visible on the website with title :arg1 and paragraph :arg2
	 */
	public function theCampaignIsVisibleOnTheWebsiteWithTitleAndParagraph( $arg1, $arg2 )
	{
		$I = $this->tester;
		$I->click( 'View Campaign' );
		$I->see( $arg1 );
		$I->see( $arg2 );
	}
}
