<?php
namespace Page\Acceptance\Admin;

class GutenbergEditor
{
    // @todo: migrate to specific class as (typed?) constants ?
    // @todo: and add command to list all known selectors ?
    public static $mainBlockSelectorButton = '.components-button.block-editor-inserter__toggle';
    public static $paragraphSelectorButton = '.components-button.editor-block-list-item-paragraph';
    public static $blockSelectorSection = '//button[contains(@class, "components-button")][text()="%s"]';
    public static $blockSelectorButton = '//ul[contains(@class, "block-editor-block-types-list")]//button/span[text()="%s"]';

    public static $titleField = '#post-title-1';

    public static $firstEditableParagraph = '.block-editor-block-list__layout [aria-label="Add block"]';
    public static $editableParagraph = '.block-editor-rich-text__editable';

    public static $prePublishButton = '.editor-post-publish-panel__toggle';
    public static $publishButton = '.editor-post-publish-button';

    public static $validationMessage = '.components-snackbar__content';

    /**
     * @var \AcceptanceTester;
     */
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    /**
     * @Given I open dashboard page
     */
    public function openDashboardPage(): void
    {
        $I = $this->tester;
        $I->amOnPage(Navigation::pageLink('Dashboard'));
    }

    /**
     * @Given I am on a new post page
     */
    public function newPostPage(): void
    {
        $I = $this->tester;
        $I->amOnPage(Navigation::pageLink('Posts > Add New'));
    }

    /**
     * @When I add a title :arg1
     */
    public function addTitle(string $title): void
    {
        $I = $this->tester;
        $I->fillField(self::$titleField, $title);
    }

    /**
     * @When I add a paragraph :arg1
     */
    public function addParagraph(?string $text): void
    {
        $I = $this->tester;

        // New post starts with an empty paragraph block,
        // if it is there, we use it
        $firstParagraphExists = $I->checkIfElementExists(self::$firstEditableParagraph);

        if ($firstParagraphExists) {
            $I->click(self::$firstEditableParagraph);
            $I->waitForElement(self::$editableParagraph, 1);
        } else {
            $this->addBlock('Common Blocks > Paragraph');
            $I->waitForElement(self::$editableParagraph, 1);
        }

        if (null !== $text) {
            $I->pressKey(self::$editableParagraph, $text);
        }
    }

    /**
     * @When /I publish the (post|page)/
     */
    public function publishPost(): void
    {
        $I = $this->tester;
        $I->click(self::$prePublishButton);
        $I->waitForElement(self::$publishButton, 1);
        $I->click(self::$publishButton);

        // @todo: memorize new post id
    }

    /**
     * @todo: paste does not currently work
     * @see self::pasteText()
     * 
     * @When I paste a video link :link
     */
    public function pasteYoutubeLink(string $link): void
    {
        $I = $this->tester;

        $this->addBlock('Embeds > YouTube');
        $I->pressKey('.has-selected-ui[aria-label="Block: YouTube"] input[type="url"]', $link);
        $I->click('.has-selected-ui[aria-label="Block: YouTube"] button[type="submit"]');
    }

    /**
     * @When I paste :text
     */
    public function pasteText(string $text): void
    {
        // @todo: paste does not currently work, 
        // @todo: try ctrl+c or find out why chrome arg doesn't work
        //$I = $this->tester;
        //$I->executeJS('navigator.clipboard.writeText(arguments[0])', [$text]);
        //$this->addParagraph($text);
        //$I->pressKey('.block-editor-rich-text__editable', ['ctrl', 'v']);
        throw new \Exception(__METHOD__ . ': not implemented.');
    }

    /**
     * Blockpath should be 'Category name > Block name'
     * @example Embeds > YouTube
     * @example Layout Elements > Buttons
     * 
     * @When I add a block :blockpath
     */
    public function addBlock(string $blockpath): void
    {
        $I = $this->tester;
        
        $path = explode(' > ', $blockpath);
        $sectionSelector = sprintf(self::$blockSelectorSection, $path[0]);
        $blockSelector = sprintf(self::$blockSelectorButton, $path[1]);

        $this->openBlockSelector();
        $I->click($sectionSelector);
        $I->waitForElement($blockSelector, 1);
        $I->click($blockSelector);
    }

    /**
     * @When I open block selector
     */
    public function openBlockSelector(): void
    {
        $I = $this->tester;
        $I->click(self::$mainBlockSelectorButton);
    }

    /**
     * @Then a message :message is displayed
     * @Then I see a message :message
     */
    public function messageIsDisplayed(?string $message): void
    {
        // @todo: check message content
        $I = $this->tester;
        $I->waitForElement(self::$validationMessage, 3);
    }

    /**
     * @Then the post is visible on the website
     */
    public function postIsVisibleOnWebsite(): void
    {
        // @todo: memorize post id to visit
    }

    /**
     * @Then I see the video in the editor
     */
    public function videoIsEmbedded(): void
    {
        // @todo: get reference to video inserted
        $I = $this->tester;
        $I->waitForElement('figure.is-type-video iframe');
    }

    /**
     * @Then I see the video in the post
     */
    public function videoVisibleOnWebsite(): void
    {
        // @todo: memorize post id to visit
    }
}
