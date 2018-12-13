<?php

use tad\WPBrowser\Generators\Date;

class AcceptanceTester extends \Codeception\Actor
{
	use _generated\AcceptanceTesterActions;

	public function fillFields($data)
	{
		$I = $this;
		foreach ($data as $key => $value) {
			$I->fillField($key, $value);
		}
	}

	public function loginAsAdminCached()
	{
		$I = $this;
		$I->amOnPage('/');
		if ($I->loadSessionSnapshot('login/admin')) {
			return;
		}
		$I->loginAsAdmin();
		$I->saveSessionSnapshot('login/admin');
	}

	public function getP4Option($name)
	{
		$I = $this;
		$value = $I->grabFromDatabase('wp_options', 'option_value', ['option_name' => 'planet4_options']);
		return unserialize($value)[$name];
	}

	public function grabPostsFromDatabase($criteria = [], $columns = ['ID', 'post_name', 'post_title', 'post_content'])
	{
		$I = $this;
		return $I->grabAllFromDatabase('wp_posts', implode(',', $columns), array_merge([
			'post_type' => 'post',
			'post_status' => 'publish'
		], $criteria));

	}

	public function haveAnOldApprovedComment($id, $data)
	{
		$I = $this;
		$I->haveCommentInDatabase($id, array_merge([
			'comment_content' => 'forautoapproval',
			'comment_date' => Date::fromString('February 4th, 2015'),
			'comment_date_gmt' => Date::fromString('February 4th, 2015'),
		], $data));

	}

	public function cleanupComments($email)
	{
		$I = $this;
		$I->dontHaveCommentInDatabase(['comment_author_email' => $email]);
	}

}
