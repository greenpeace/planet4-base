<?php

declare(strict_types=1);

namespace Page\Acceptance\Admin;

use Selector\Admin\GutenbergEditor as EditorSelector;
use Selector\Admin\GutenbergEditor\BlockName;
use Selector\Admin\GutenbergEditor\BlockSection;
use Selector\Admin\GutenbergEditor\BlockSelector;

class GutenbergEditor
{
    /**
     * @var \AcceptanceTester;
     */
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function addBlock(BlockSection $blockSection, BlockName $blockName): void
    {
        $I = $this->tester;
        $blockButton = BlockSelector::block($blockName);

        $this->openBlockSelector();
        // Wait for panel to open
        $I->waitForElement('.block-editor-inserter__panel-header', 6);
        // Wait for sections to load
        $I->waitForElement($blockButton, 10);
        // Scroll and click
        $I->scrollTo($blockButton);
        $I->click($blockButton);
    }

    public function openBlockSelector(): void
    {
        $I = $this->tester;
        $I->click(BlockSelector::MAIN_BUTTON);
    }
}
