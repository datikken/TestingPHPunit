<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Dinosaur;

class DinosaurFactory
{
    public function growVelociraptor(int $length): Dinosaur
    {
        $dino = new Dinosaur('Velociraptor', true);
        $dino->setLength($length);

        return $dino;
    }
}
