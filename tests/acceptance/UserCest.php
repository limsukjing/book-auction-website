<?php

namespace App\Tests;

class UserCest
{
    public function _before(AcceptanceTester $I) {
        $I->amOnPage('/login');
        $I->see('username');
        $I->see('password');
        $form = [
            'username' => 'admin',
            'password' => 'admin'
        ];
        $I->submitForm('.login-form', $form, 'loginButton');
        $I->seeInCurrentUrl('/');

        // ORM count before addition
        $expectedCount = 7;
        $users = $I->grabEntitiesFromRepository('App\Entity\User');
        $count = count($users);

        $I->assertEquals($expectedCount, $count);
    }

    public function verifyUsersInDatabase(AcceptanceTester $I) {
        $I->seeInRepository('App\Entity\User', [
            'username' => 'admin'
        ]);

        $I->seeInRepository('App\Entity\User', [
            'username' => 'seller'
        ]);

        $I->seeInRepository('App\Entity\User', [
            'username' => 'buyer'
        ]);

        $I->seeInRepository('App\Entity\User', [
            'username' => 'Rachel Seller'
        ]);

        $I->seeInRepository('App\Entity\User', [
            'username' => 'Eleanor Buyer'
        ]);

        $I->seeInRepository('App\Entity\User', [
            'username' => 'Caleb Seller'
        ]);

        $I->seeInRepository('App\Entity\User', [
            'username' => 'Aidan Buyer'
        ]);
    }

    public function isUsernameUnique(AcceptanceTester $I) {
        $username = 'admin';

        $I->amOnPage('/user/new');
        $I->fillField('#user_username', $username);
        $I->fillField('#user_password', 'duplicated-admin');
        $I->selectOption('#user_roles', 'ROLE_ADMIN');
        $I->click('Save');

        $I->dontSeeInRepository('App\Entity\User', [
            'username' => $username,
            'password' => 'duplicated-admin'
        ]);

        // ORM count after addition
        $expectedCount = 7;
        $users = $I->grabEntitiesFromRepository('App\Entity\User');
        $count = count($users);

        $I->assertEquals($expectedCount, $count);
    }
}
