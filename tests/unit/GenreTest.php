<?php

namespace App\Entity\Tests;

use Codeception\Test\Unit;
use App\Entity\Genre;

class GenreTest extends Unit
{
    public function testCreateGenreObject()
    {
        // Arrange
        $genre = new Genre();

        // Assert
        $this->assertNotNull($genre);
    }

    public function testSetGenreType()
    {
        // Arrange
        $genre = new Genre();
        $type = 'Science Fiction';
        $expectedResult = $type;

        // Act
        $currentGenre = $genre->setType($type);
        $result = $currentGenre->getType();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}