<?php

namespace App\Entity\Tests;

use Codeception\Test\Unit;
use App\Entity\Book;

class BookTest extends Unit
{
    public function testCreateBookObject()
    {
        // Arrange
        $book = new Book();

        // Assert
        $this->assertNotNull($book);
    }

    public function testCalculateTotalStartingPrice()
    {
        // Arrange
        $book1 = new Book();
        $book1->setStartingPrice(1);
        $book2 = new Book();
        $book2->setStartingPrice(1);
        $expectedResult = 2;

        // Act
        $startingPrice1 = $book1->getStartingPrice();
        $startingPrice2 = $book2->getStartingPrice();
        $result = $startingPrice1 + $startingPrice2;

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}