<?php
namespace Step\Acceptance\Admin;

use Page\Acceptance\Admin\Navigation;

/**
 * Navigation: steps for navigating in admin interface
 */
class NavigationSteps
{
    /**
     * @var \AcceptanceTester;
     */
    protected $tester;

    /**
     * @var GutenbergEditorPage
     */
    private $page;

    public function __construct(
        \AcceptanceTester $I
    ) {
        $this->tester = $I;
    }

    /**
     * @example I navigate to "Posts > Add new"
     * 
     * @When I navigate to :pagepath
     */
    public function iNavigateTo(string $pagepath): void
    {
        $I = $this->tester;
        $I->amOnPage(Navigation::pageLink($pagepath));
    }

    /**
     * @Given I open the dashboard
     */
    public function iOpenTheDashboard(): void
    {
        $I = $this->tester;
        $I->amOnPage(Navigation::pageLink('Dashboard'));
    }

    /**
     * @Given I am on a new post page
     */
    public function iAmOnANewPostPage(): void
    {
        $I = $this->tester;
        $I->amOnPage(Navigation::pageLink('Posts > Add New'));
    }

    /**
     * @Given I am on a import campaign page
     */
    public function iAmOnAImportCampaignPage(): void
    {
      $I = $this->tester;
      $I->amOnPage(Navigation::pageLink('Tools > Import'));
    }

    /**
     * @Given I am on a new campaign page
     */
    public function iAmOnANewCampaignPage()
    {
      $I = $this->tester;
      $I->amOnPage(Navigation::pageLink('Campaigns > Add New'));
    }
}
