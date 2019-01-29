<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('check carousel is rendered correctly');

// homepage has a shortcake_carousel
$I->amOnPage('/');

// scroll down or the cookie banner covers the "next" button
$I->scrollTo('.carousel-item-container');

// we see the first image
$I->seeElement('.carousel-item.active img', [
	'src' => 'http://www.planet4.test/wp-content/uploads/2018/05/af565f01-gp0stpr4h_web_size_with_credit_line.jpg']
);

// click the next link
$I->click('.carousel-control-next-icon');

// Wair for the scrolling to finish and the .active class being appended to the second image
$I->wait(2);

// and see the next image :)
$I->seeElement('.carousel-item.active img', [
	'src' => 'http://www.planet4.test/wp-content/uploads/2018/05/ea8f1af6-gp0stq27a_web_size_with_credit_line.jpg']
);
