<?php

namespace Tests\AppBundle\Factory;

use AppBundle\Factory\DinosaurFactory;
use AppBundle\Service\DinosaurLengthDeterminator;
use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Dinosaur;

class DinosaurFactoryTest extends TestCase
{
    private $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $lengthDeterminator;

    public function setUp(): void
    {
        $this->lengthDeterminator = $this->createMock(DinosaurLengthDeterminator::class);
        $this->factory = new DinosaurFactory($this->lengthDeterminator);
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
    public function testItGrowsADinoFromASpec(string $spec, bool $expectedIsCornivorous)
    {
        $this->lengthDeterminator
            ->expects($this->once())
            ->method('getLengthFromSpecification')
            ->with($spec)
            ->willReturn(20);

        $dino = $this->factory->growFromSpecification($spec);
        $this->assertSame($expectedIsCornivorous, $dino->isCarnivorous());
        $this->assertSame(20, $dino->getLength());
    }

    public function getSpecificationTests()
    {
        return [
            ['large carnivorous dinosaur', true],
            'default response' => ['give me all the cookies!!!', false],
            ['large herbivore', false]
        ];
    }
}
