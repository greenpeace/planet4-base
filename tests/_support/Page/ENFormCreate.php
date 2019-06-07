<?php

namespace Page;

class ENFormCreate {
	/**
	 * Declare UI map for this page here. CSS or XPath allowed.
	 * public static $usernameField = '#username';
	 * public static $formSubmitButton = "#mainForm input[type=submit]";
	 */

	// include url of current page
	public static $URL = '/wp-admin/post-new.php?post_type=p4en_form';
	public static $addFieldButton = '.add-en-field';
	public static $metaboxHeading = '.handlediv > span';
	public static $enformMetaField = '#p4enform_fields';

}
