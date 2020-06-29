<?php

declare(strict_types=1);

namespace Selector\Admin\GutenbergEditor;

use MyCLabs\Enum\Enum;

/**
 * Selectors for the editor sidebar
 * 
 * @method static Sidebar TABS()
 * @method static Sidebar DOCUMENT_TAB()
 * @method static Sidebar BLOCK_TAB()
 * @method static Sidebar ACTIVE_TAB()
 */
class Sidebar extends Enum
{
    private const TABS = '.edit-post-sidebar__panel-tabs';
    private const DOCUMENT_TAB = '.edit-post-sidebar__panel-tab[data-label="Document"]';
    private const BLOCK_TAB = '.edit-post-sidebar__panel-tab[data-label="Block"]';
    private const ACTIVE_TAB = '.edit-post-sidebar__panel-tab.is_active';
}
