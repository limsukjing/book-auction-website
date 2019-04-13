<?php

namespace App\Tests;

class GenreCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/genre/new');
        $I->see('username');
        $I->see('password');
        $form = [
            'username' => 'admin',
            'password' => 'admin'
        ];
        $I->submitForm('.login-form', $form, 'loginButton');
        $I->seeInCurrentUrl('/genre/new');

        // ORM count before addition
        $expectedCount = 8;
        $genres = $I->grabEntitiesFromRepository('App\Entity\Genre');
        $count = count($genres);

        $I->assertEquals($expectedCount, $count);
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $genreType = 'Science Fiction';

        $I->haveInRepository('App\Entity\Genre', [
            'type' => $genreType,
            'image' => 'genre_scifi.png'
        ]);

        $I->seeInRepository('App\Entity\Genre', [
            'type' => $genreType,
            'image' => 'genre_scifi.png'
        ]);

        // ORM count after addition
        $expectedCount = 9;
        $genres= $I->grabEntitiesFromRepository('App\Entity\Genre');
        $count = count($genres);

        $I->assertEquals($expectedCount, $count);
    }
}
