<?php
use \Codeception\Util\Locator;

$I = new AcceptanceTester($scenario);

$I->wantTo('check carousel is rendered correctly');

// homepage has a shortcake_carousel
$I->amOnPage('/');

// we see the first image
$I->seeElement('img', [
		'src' => 'http://www.planet4.test/wp-content/uploads/2018/05/ea8f1af6-gp0stq27a_web_size_with_credit_line.jpg']
);

// we can click the next icon
$I->click('.carousel-control-next-icon');

// Lets scroll down to the carousel, so that screenshots show what we have
$I->scrollTo('.carousel-wrap');