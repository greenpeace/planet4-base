<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check article listing on home page');

$I->amOnPage('/');

$I->see('In the news');

$I->seeNumberOfElements('.article-listing .article-list-item', 3);

// should have the title of each article
foreach ($I->grabPostsFromDatabase() as $post) {
	$I->see($post['post_title']);
}
