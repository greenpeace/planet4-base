<?php

use tad\WPBrowser\Generators\Date;

class AcceptanceTester extends \Codeception\Actor
{
	use _generated\AcceptanceTesterActions;


	/**
	 * A simple helper to fill in a form without repetitively calling `$I->fillField()`
	 *
	 * @param $data key/value pairs to fill the form with
	 */
	public function fillFields($data)
	{
		$I = $this;
		foreach ($data as $key => $value) {
			$I->fillField($key, $value);
		}
	}

	/**
	 * Login to WordPress as the admin user saving the session as snapshot to make
	 * subsequent admin logins reuse the session to save time.
	 */
	public function loginAsAdminCached()
	{
		$I = $this;
		$I->amOnPage('/');
		//if ($I->loadSessionSnapshot('login/admin')) {
		//	return;
		//}
		$I->loginAsAdmin();
		//$I->saveSessionSnapshot('login/admin');
	}


	/**
	 * Get the value of a planet4 option directly from the WordPress database
	 *
	 * @param $name option name to retrieve
	 * @return mixed
	 */
	public function getP4Option($name)
	{
		$I = $this;
		$value = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => 'planet4_options']);
		return unserialize($value)[$name];
	}

	/**
	 * Fetch a list of posts from the WordPress database
	 *
	 * @param array $criteria add database criteria to filter by
	 * @param array $columns overide which columns to return
	 * @return a list of posts
	 */
	public function grabPostsFromDatabase($criteria = [], $columns = ['ID', 'post_name', 'post_title', 'post_content'])
	{
		$I = $this;
		return $I->grabAllFromDatabase('wp_posts', implode(',', $columns), array_merge([
			'post_type' => 'post',
			'post_status' => 'publish'
		], $criteria));

	}

	/**
	 * To auto approve new comments use this to first create an old comment
	 * Subsequent comments will be auto-approved (depending on WordPress discussion settings)
	 *
	 * @param $id post id to add the comment to
	 * @param $data comment data to merge into basic comment data
	 */
	public function haveAnOldApprovedComment($id, $data)
	{
		$I = $this;
		$I->haveCommentInDatabase($id, array_merge([
			'comment_content' => 'forautoapproval',
			'comment_date' => Date::fromString('February 4th, 2015'),
			'comment_date_gmt' => Date::fromString('February 4th, 2015'),
		], $data));
	}

	/**
	 * Remove all comments for a given email address
	 *
	 * @param $email
	 */
	public function cleanupComments($email)
	{
		$I = $this;
		$I->dontHaveCommentInDatabase(['comment_author_email' => $email]);
	}

}
