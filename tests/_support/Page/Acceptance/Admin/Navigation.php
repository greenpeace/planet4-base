<?php
namespace Page\Acceptance\Admin;

class Navigation
{
    /**
     * @var \AcceptanceTester;
     */
    private $tester;

    // @todo: migrate keys to (typed?) constants
    public static $linkMap = [
        'Dashboard' => '/wp-admin/index.php',
        'Posts' => '/wp-admin/edit.php',
        'Posts > All Posts' => '/wp-admin/edit.php',
        'Posts > Add New' => '/wp-admin/post-new.php',
        'Posts > Categories' => '/wp-admin/edit-tags.php?taxonomy=category',
        'Posts > Tags' => '/wp-admin/edit-tags.php?taxonomy=post_tag',
        'Posts > Post Types' => '/wp-admin/edit-tags.php?taxonomy=p4-page-type',
        'Posts > Posts Report' => '/wp-admin/edit.php?taxonomy=posts-report',
    ];

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    /**
     * @When I am on admin page :location
     */
    public function navigateTo(string $location): void
    {
        $I = $this->tester;
        $I->amOnPage(self::$linkMap[$location]);
    }

    /**
     * Return admin page relative URL based on a string 'Group name > Page name'
     */
    public static function pageLink(string $pageName): ?string
    {
        if (!isset(self::$linkMap[$pageName])) {
            throw new \Exception('No page named ' . $pageName);
        }
        return self::$linkMap[$pageName];
    }
}