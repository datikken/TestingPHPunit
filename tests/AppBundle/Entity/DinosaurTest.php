<?php

namespace Tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Dinosaur;

class DinosaurTest extends TestCase
{
    public function testSettingsLength()
    {
        $dino = new Dinosaur();
        $this->assertSame(0, $dino->getLength());

        $dino->setLength(9);
        $this->assertSame(9, $dino->getLength());
    }

    public function testDinoHasNotShrunk()
    {
        $dino = new Dinosaur();
        $dino->setLength(15);

        $this->assertGreaterThan(12, $dino->getLength());
    }

    public function testReturnsFullSpec()
    {
        $dino = new Dinosaur('Tyrannosaurus', true);
        $dino->setLength(12);

        $this->assertSame('The Tyrannosaurus carnivorous dinosaur is 12 meters long', $dino->getSpecification());
    }
}
