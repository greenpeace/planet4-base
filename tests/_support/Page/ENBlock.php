<?php

namespace Page;

/**
 * Declare UI map for this page here. CSS or XPath allowed.
 * public static $usernameField = '#username';
 * public static $formSubmitButton = "#mainForm input[type=submit]";
 */
class ENBlock {
	// Include url of current page.
	public static $URL                     = '/wp-admin/post-new.php?post_type=p4en_form';
	public static $shortcodeName           = 'shortcake_enblock';
	public static $addFieldButton          = '.add-en-field';
	public static $pageElementButton       = '[data-shortcode="shortcake_enblock"]';
	public static $enPageSelect            = 'en_page_id';
	public static $formStyleRadio          = 'input[name=en_form_style]';
	public static $formStyleInputName      = 'en_form_style';
	public static $goalSelect              = 'enform_goal';
	public static $titleField              = 'title';
	public static $descriptionField        = 'description';
	public static $contentTitleField       = 'content_title';
	public static $contentDescriptionField = 'content_description';
	public static $buttonTextField         = 'button_text';
	public static $enFormSelect            = 'en_form_id';
	public static $enTitleSizeSelect       = 'content_title_size';
}
