<?php

namespace App\Entity\Tests;

use App\Entity\User;
use Codeception\Test\Unit;
use App\Entity\Comment;

class CommentTest extends Unit
{
    public function testCreateCommentObject()
    {
        // Arrange
        $comment = new Comment();

        // Assert
        $this->assertNotNull($comment);
    }

    public function testSetCommentAuthor()
    {
        // Arrange
        $user = new User();
        $comment = new Comment();
        $expectedResult = $user;

        // Act
        $currentComment = $comment->setAuthor($user);
        $result = $currentComment->getAuthor();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}