<?php

namespace Tests\AppBundle\Factory;

use AppBundle\Factory\DinosaurFactory;
use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Dinosaur;

class DinosaurFactoryTest extends TestCase
{
    public function testItGrowsAVelociraptor()
    {
        $factory = new DinosaurFactory();
        $dino = $factory->growVelociraptor(5);

        $this->assertInstanceOf(Dinosaur::class, $dino);
        $this->assertIsString($dino->getGenus());
        $this->assertSame('Velociraptor', $dino->getGenus());
        $this->assertSame(5, $dino->getLength());
    }
}
