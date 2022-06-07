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

    /**
     * @dataProvider getSpecificationTests
     * @param string $spec
     * @param bool $expectedIsLarge
     * @param bool $expectedIsCornivorous
     * @return void
     */
    public function testItGrowsADinoFromASpec(string $spec, bool $expectedIsLarge, bool $expectedIsCornivorous)
    {
        $dino = $this->factory->growFromSpecification($spec);
        if($expectedIsLarge) {
            $this->assertGreaterThanOrEqual(Dinosaur::LARGE, $dino->getLength());
        } else {
            $this->assertLessThan(Dinosaur::LARGE, $dino->getLength());
        }

        $this->assertSame($expectedIsCornivorous, $dino->isCarnivorous());
    }

    public function getSpecificationTests()
    {
        return [
            ['large carnivorous dinosaur', true, true],
            'default response' => ['give me all the cookies!!!', false, false],
            ['large herbivore', true, false]
        ];
    }

    /**
     * @dataProvider getHugeDinoSpecTests
     * @param string $spec
     * @return void
     */
    public function testItGrowsAHugeDinosaur(string $spec)
    {
        $dino = $this->factory->growFromSpecification($spec);
        $this->assertGreaterThanOrEqual(Dinosaur::HUGE, $dino->getLength());
    }

    public function getHugeDinoSpecTests()
    {
        return [
            ['huge dinosaur'],
            ['huge dino'],
            ['huge'],
            ['OMG'],
            ['😱'],
        ];
    }
}
