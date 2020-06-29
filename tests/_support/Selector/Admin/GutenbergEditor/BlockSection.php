<?php

declare(strict_types=1);

namespace Selector\Admin\GutenbergEditor;

use MyCLabs\Enum\Enum;

/**
 * Sections in the block selector
 * 
 * @method static BlockSection MOST_USED()
 * @method static BlockSection P4_BLOCKS()
 * @method static BlockSection P4_BLOCKS_BETA()
 * @method static BlockSection COMMON_BLOCKS()
 * @method static BlockSection FORMATTING()
 * @method static BlockSection LAYOUT_ELEMENTS()
 * @method static BlockSection WIDGETS()
 * @method static BlockSection EMBEDS()
 */
class BlockSection extends Enum
{
    private const MOST_USED = 'Most used';
    private const P4_BLOCKS = 'Planet 4 Blocks';
    private const P4_BLOCKS_BETA = 'Planet 4 Blocks - BETA';
    private const COMMON_BLOCKS = 'Common Blocks';
    private const FORMATTING = 'Formatting';
    private const LAYOUT_ELEMENTS = 'Layout Elements';
    private const WIDGETS = 'Widgets';
    private const EMBEDS = 'Embeds';
}
