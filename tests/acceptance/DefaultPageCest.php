<?php

namespace App\Tests;

use Codeception\Example;

class DefaultPageCest
{
    /**
     * @example(url="/", text="the bookish life")
     * @example(url="/about", text="our story")
     * @example(url="/genre", text="all genres")
     * @example(url="/genre/{id}", text="#")
     * @example(url="/book", text="all books")
     * @example(url="/book/{id}", text="author")
     * @example(url="/sitemap", text="diagram")
     */
    public function defaultPageContent(AcceptanceTester $I, Example $example)
    {
        $I->amOnPage($example['url']);
        $I->see($example['text']);
    }

    /**
     * @example(url="/", link="HOME")
     * @example(url="/about", link="ABOUT US")
     * @example(url="/genre", link="SHOP BY GENRE")
     * @example(url="/book", link="BOOKS")
     * @example(url="/sitemap", link="SITEMAP")
     */
    public function defaultPageNavigationBar(AcceptanceTester $I, Example $example)
    {
        $I->amOnPage('/');
        $I->click($example['link']);
        $I->seeCurrentUrlEquals($example['url']); // full URL
        $I->seeInCurrentUrl($example['url']); // part of URL
    }
}
