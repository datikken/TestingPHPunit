<?php

namespace Tests\AppBundle\Factory;

use AppBundle\Factory\DinosaurFactory;
use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Dinosaur;

class DinosaurFactoryTest extends TestCase
{
    private $factory;

    public function setUp(): void
    {
        $this->factory = new DinosaurFactory();
    }

    public function testItGrowsAVelociraptor()
    {
        $dino = $this->factory->growVelociraptor(5);

        $this->assertInstanceOf(Dinosaur::class, $dino);
        $this->assertIsString($dino->getGenus());
        $this->assertSame('Velociraptor', $dino->getGenus());
        $this->assertSame(5, $dino->getLength());
    }

    public function testitGrowsATriceratops()
    {
        $this->markTestIncomplete('Waiting for information');
    }

    public function testItGrowsABabyVelociraptor()
    {
        if (!class_exists('Nanny')) {
            $this->markTestSkipped('There is no one to watch');
        }

        $dino = $this->factory->growVelociraptor(1);
        $this->assertSame(1, $dino->getLength());
    }
}
