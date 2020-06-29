<?php

declare(strict_types=1);

namespace Selector\Admin;

use MyCLabs\Enum\Enum;

/**
 * Selectors in the post content editor
 * 
 * @method static GutenbergEditor TITLE_FIELD()
 * @method static GutenbergEditor EDITABLE_PARAGRAPH()
 * @method static GutenbergEditor FIRST_EDITABLE_PARAGRAPH()
 * @method static GutenbergEditor PRE_PUBLISH_BUTTON()
 * @method static GutenbergEditor PUBLISH_BUTTON()
 * @method static GutenbergEditor VALIDATION_MESSAGE()
 * @method static GutenbergEditor SIDEBAR()
 */
class GutenbergEditor extends Enum
{
    private const TITLE_FIELD = '#post-title-1';
    private const EDITABLE_PARAGRAPH = '.block-editor-rich-text__editable';
    private const FIRST_EDITABLE_PARAGRAPH = '.block-editor-block-list__layout [aria-label="Add block"]';

    private const PRE_PUBLISH_BUTTON = '.editor-post-publish-panel__toggle';
    private const PUBLISH_BUTTON = '.editor-post-publish-button';

    private const VALIDATION_MESSAGE = '.components-snackbar';

    private const SIDEBAR = '.block-editor-editor-skeleton__sidebar';
}
