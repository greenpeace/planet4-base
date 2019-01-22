<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('add a comment');

$email = 'testuser@planet4.test';
$author = 'test user';
$comment = 'test comment ' . $I->generateRandomString();

$I->cleanupComments($email);

$id = $I->havePostInDatabase([
	'post_status' => 'publish',
	'terms' => [
		'category' => ['Energy'],
		'p4-page-type' => ['press']
	]
]);

// we create a preapproved comment in the database, which means the one we create on the page will be auto approved
// this would change behaviour depending on the "Discussion Settings / Before a comment appears" options selected
// we create it in the past to avoid triggering the comment flood prevention
$I->haveAnOldApprovedComment($id, [
	'comment_author_email' => $email,
	'comment_author' => $author
]);

$I->amOnPage('/?p=' . $id);

$I->submitForm('#commentform', [
	'comment' => $comment,
	'author' => $author,
	'email' => $email
]);

// we can now see the comment on the page
$I->see($comment, '.comments-section');

$I->cleanupComments($email);
