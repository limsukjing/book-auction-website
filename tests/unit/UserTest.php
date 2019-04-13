<?php

namespace App\Entity\Tests;

use Codeception\Test\Unit;
use App\Entity\User;

class UserTest extends Unit
{
    public function testCreateUserObject()
    {
        // Arrange
        $user = new User();

        // Assert
        $this->assertNotNull($user);
    }

    public function testSetUsername()
    {
        // Arrange
        $user = new User();
        $username = 'test';
        $expectedResult = $username;

        // Act
        $currentUser = $user->setUsername($username);
        $result = $currentUser->getUsername();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}