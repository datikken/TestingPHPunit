<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use AppBundle\Exception\DinosAreRunningRampantException;
use AppBundle\Exception\NotABuffetException;
use PHPUnit\Framework\TestCase;

class EnclosureTest extends TestCase
{
    public function testItHasNoDinosaursByDefault()
    {
        $enclosure = new Enclosure(true);
        $this->assertEmpty(0, $enclosure->getDinosaurs());
    }

    public function testItAddsDinosaurs()
    {
        $enclosure = new Enclosure(true);
        $enclosure->addDinosaur(new Dinosaur());
        $enclosure->addDinosaur(new Dinosaur());

        $this->assertCount(2, $enclosure->getDinosaurs());
    }

    public function testCarnivorousDoentMixWithHerbivorous()
    {
        $enclosure = new Enclosure(true);
        $enclosure->addDinosaur(new Dinosaur());

        $this->expectException(NotABuffetException::class);
        $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));
    }

    public function testItDoesntAllowedToAddDinoToInsecureClosures()
    {
        $enclosure = new Enclosure(false);

        $this->expectException(DinosAreRunningRampantException::class);
        $this->expectExceptionMessage('Are you crazy?');

        $enclosure->addDinosaur(new Dinosaur());
    }
}
