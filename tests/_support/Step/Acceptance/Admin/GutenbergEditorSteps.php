<?php
namespace Step\Acceptance\Admin;

use Page\Acceptance\Admin\GutenbergEditor;
use Selector\Admin\GutenbergEditor as EditorSelector;
use Selector\Admin\GutenbergEditor\BlockName;
use Selector\Admin\GutenbergEditor\BlockSection;

/**
 * Gutenberg: steps to use Gutenberg editor
 */
class GutenbergEditorSteps
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
        \AcceptanceTester $I,
        GutenbergEditor $page
    ) {
        $this->tester = $I;
        $this->page = $page;
    }

    /**
     * @example I add a title "My title !"
     * 
     * @When I add a title :arg1
     */
    public function iAddATitle(string $title): void
    {
        $I = $this->tester;
        $I->fillField(EditorSelector::TITLE_FIELD(), $title);
    }

    /**
     * @When I add a paragraph :arg1
     */
    public function iAddAParagraph(?string $text): void
    {
        $I = $this->tester;

        // New post starts with an empty paragraph block,
        // if it is there, we use it
        $firstParagraphExists = $I->checkIfElementExists(EditorSelector::FIRST_EDITABLE_PARAGRAPH());

        if ($firstParagraphExists) {
            $I->click(EditorSelector::FIRST_EDITABLE_PARAGRAPH());
            $I->waitForElement(EditorSelector::EDITABLE_PARAGRAPH(), 1);
        } else {
            $this->iAddABlockFromSection('Paragraph', 'Common Blocks');
            $I->waitForElement(EditorSelector::EDITABLE_PARAGRAPH(), 1);
        }

        if (null !== $text) {
            $I->pressKey(EditorSelector::EDITABLE_PARAGRAPH(), $text);
        }
    }

    /**
     * @example I publish the post
     * @example I publish the page
     * @example I publish the campaign
     * 
     * @When /I publish the (post|page|campaign)/
     */
    public function iPublishThePost(): void
    {
        $I = $this->tester;
        $I->click(EditorSelector::PRE_PUBLISH_BUTTON());
        $I->waitForElement(EditorSelector::PUBLISH_BUTTON(), 1);
        $I->click(EditorSelector::PUBLISH_BUTTON());

        // @todo: memorize new post id
    }

    /**
     * @todo: paste does not currently work
     * @see self::pasteText()
     * @example I paste a video link "https://www.youtube.com/watch?v=dQw4w9WgXcQ"
     * 
     * @When I paste a video link :link
     */
    public function iPasteAYoutubeLink(string $link): void
    {
        $I = $this->tester;

        $this->iAddABlockFromSection('YouTube', 'Embeds');
        $I->waitForElement('.has-selected-ui[aria-label="Block: YouTube"] input[type="url"]', 1);
        $I->pressKey('.has-selected-ui[aria-label="Block: YouTube"] input[type="url"]', $link);
        $I->click('.has-selected-ui[aria-label="Block: YouTube"] button[type="submit"]');
    }

    /**
     * @example I paste "Copy-pasta"
     * 
     * @When I paste :text
     */
    public function iPasteText(string $text): void
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
     * @example I add a block "YouTube" from section "Embeds"
     * 
     * @When I add a block :blockname from section :blocksection
     */
    public function iAddABlockFromSection(string $blockName, string $blockSection): void
    {
        $this->page->addBlock(
            new BlockSection($blockSection),
            new BlockName($blockName)
        );
    }

    /**
     * @When I open the block selector
     */
    public function iOpenTheBlockSelector(): void
    {
        $this->page->openBlockSelector();
    }

    /**
     * @example I see a validation message
     * @example I see a validation message "Post Published."
     *
     * @Then I see a validation message :message
     */
    public function iSeeAValidationMessage(?string $message): void
    {
        // @todo: check message content
        $I = $this->tester;
        $I->waitForElement((string) EditorSelector::VALIDATION_MESSAGE(), 10);
    }

    /**
     * @Then the post is visible on the website
     */
    public function thePostIsVisibleOnTheWebsite(): void
    {
        // @todo: memorize post id to visit
    }

    /**
     * @Then I see the video in the editor
     */
    public function iSeeTheVideoInTheEditor(): void
    {
        // @todo: get reference to video inserted
        $I = $this->tester;
        $I->waitForElement('figure.is-type-video iframe');
    }

    /**
     * @Then I see the video in the post published
     */
    public function iSeeTheVideoInThePostPublished(): void
    {
        // @todo: memorize post id to visit
    }
}
