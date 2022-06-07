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
}
