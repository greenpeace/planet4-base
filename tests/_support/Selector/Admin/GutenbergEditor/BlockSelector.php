<?php

declare(strict_types=1);

namespace Selector\Admin\GutenbergEditor;

use MyCLabs\Enum\Enum;

/**
 * Selectors for the block selector
 * 
 * @method static BlockSelector MAIN_BUTTON()
 */
class BlockSelector extends Enum
{
    private const MAIN_BUTTON = '.components-button.block-editor-inserter__toggle';
    private const SECTION = '//button[contains(@class, "components-button")][text()="%s"]';
    private const BLOCK = '//ul[contains(@class, "block-editor-block-types-list")]//button/span[text()="%s"]';

    public static function SECTION(BlockSection $sectionName): self
    {
        return new BlockSelector(sprintf(self::SECTION, (string) $sectionName));
    }

    public static function BLOCK(BlockName $blockName): self
    {
        return new BlockSelector(sprintf(self::BLOCK, (string) $blockName));
    }

    /**
     * Check if is valid enum value
     * Overwrites Enum method to allow for parameters in const
     *
     * @param $value
     * @see Enum::isValid()
     * @return bool
     */
    public static function isValid($value): bool
    {
        return true;
    }
}
