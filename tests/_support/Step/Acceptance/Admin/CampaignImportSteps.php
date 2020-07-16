<?php
namespace Step\Acceptance\Admin;

use Page\Acceptance\Admin\GutenbergEditor;

/**
 * Gutenberg: steps to use Gutenberg editor
 */
class CampaignImportSteps
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
   * @example I select xml file to import "test-campaign.lorem-ipsum.xml"
   *
   * @When I select xml file to import :arg1
   */
  public function iSelectXmlFileToImport($arg1)
  {
    $I = $this->tester;
    $I->attachFile( '.wp-upload-form > p > #upload', $arg1 );
  }

  /**
   * @When I upload file and import
   */
  public function iUploadFileAndImport()
  {
    $I = $this->tester;
    $I->click( '.submit > #submit' );
  }

  /**
   * @When I select the import of attachments
   */
  public function iSelectTheImportOfAttachments()
  {
    $I = $this->tester;
    $I->waitForElement( '#import-attachments', 5);
    $I->checkOption( '#import-attachments' );
  }

  /**
   * @When I submit the import form
   */
  public function iSubmitTheImportForm()
  {
    $I = $this->tester;
    $I->click( '.submit > .button' );
  }

  /**
   * @Then I see a successful import message
   */
  public function iSeeASuccessfulImportMessage()
  {
    $I = $this->tester;
    $I->waitForText( 'All done.', 5);
    $I->see('Have fun!');
    $I->see('Remember to update the passwords and roles of imported users.');
  }

  /**
   * @Then the campaign is imported in DB as draft
   */
  public function theCampaignIsImportedInDBAsDraft()
  {
    $I = $this->tester;
    $I->seeInDatabase( 'wp_posts' , ['post_title' => 'Lorem Ipsum', 'post_type' => 'campaign', 'post_status' => 'draft' ]);
  }
}
