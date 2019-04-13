<?php

namespace App\Tests;

use Codeception\Example;

class ProtectedPageCest
{
    /**
     * @example(url="/", text="login")
     * @example(url="/user", text="password")
     * @example(url="/auction", text="password")
     * @example(url="/bid", text="password")
     * @example(url="/genre/new", text="password")
     * @example(url="/genre/{id}/edit", text="password")
     * @example(url="/book/new", text="password")
     * @example(url="/book/{id}/edit", text="password")
     */
    public function isPasswordProtected(AcceptanceTester $I, Example $example)
    {
        $I->amOnPage($example['url']);
        $I->see($example['text']);
    }

    /**
     * @example(url="/", text="logout")
     * @example(url="/", text="my auctions")
     * @example(url="/", text="my bids")
     * @example(url="/", text="users")
     * @example(url="/genre", text="create new genre")
     * @example(url="/genre/{id}", text="edit/delete")
     * @example(url="/book", text="create new book")
     * @example(url="/book/{id}", text="reserve price")
     * @example(url="/book/{id}", text="add comment")
     */
    public function isCRUDOptionHidden(AcceptanceTester $I, Example $example)
    {
        $I->amOnPage($example['url']);
        $I->dontSee($example['text']);
    }

    public function isLoginProtected(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->see('username');
        $I->see('password');
        $form = [
            'username' => 'abc',
            'password' => 'abc'
        ];
        $I->submitForm('.login-form', $form, 'loginButton');
        $I->see('unauthorized');
    }

    public function isAdminCRUDProtected(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->see('username');
        $I->see('password');
        $form = [
            'username' => 'seller',
            'password' => 'seller'
        ];
        $I->submitForm('.login-form', $form, 'loginButton');
        $I->dontSee('users');
    }

    public function isRoleInherited(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->see('username');
        $I->see('password');
        $form = [
            'username' => 'admin',
            'password' => 'admin'
        ];
        $I->submitForm('.login-form', $form, 'loginButton');
        $I->see('my auctions');
        $I->see('my bids');
    }
}
