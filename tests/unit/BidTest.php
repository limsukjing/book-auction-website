<?php

namespace App\Entity\Tests;

use Codeception\Test\Unit;
use App\Entity\Bid;

class BidTest extends Unit
{
    public function testCreateBidObject()
    {
        // Arrange
        $bid = new Bid();

        // Assert
        $this->assertNotNull($bid);
    }

    public function testSetBidAmount()
    {
        // Arrange
        $bid = new Bid();
        $amount = 5;
        $expectedResult = $amount;

        // Act
        $currentBid = $bid->setAmount($amount);
        $result = $currentBid->getAmount();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testCalculateTotalBidAmount()
    {
        // Arrange
        $bid1 = new Bid();
        $bid1->setAmount(1);
        $bid2 = new Bid();
        $bid2->setAmount(1);
        $expectedResult = 2;

        // Act
        $bidAmount1 = $bid1->getAmount();
        $bidAmount2 = $bid2->getAmount();
        $result = $bidAmount1 + $bidAmount2;

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}