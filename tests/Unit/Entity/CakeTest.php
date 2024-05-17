<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Cake;
use PHPUnit\Framework\TestCase;

class CakeTest extends TestCase
{
    private ?Cake $cake;

    public function setUp(): void
    {
        $this->cake = new Cake();
    }

    public function tearDown(): void
    {
        $this->cake = null;
    }

    public function testInstance(): void
    {
        $this->assertInstanceOf(Cake::class, $this->cake);
    }

    public function testCakeEntity(): void
    {
        $this->cake->setName('Cake Test');
        $this->assertEquals('Cake Test', $this->cake->getName());
    }
}
