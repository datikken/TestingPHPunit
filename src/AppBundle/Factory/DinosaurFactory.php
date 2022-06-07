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

    public function growFromSpecification(string $spec): Dinosaur
    {
        $codeName = 'InG-' . random_int(1, 9999);
        $length = random_int(1, Dinosaur::LARGE - 1);
        $isCarnivorous = false;

        if(strpos($spec, 'large') !== false) {
            $length = random_int(Dinosaur::LARGE, 100);
        }

        if(strpos($spec, 'carnivorous') !== false) {
            $isCarnivorous = true;
        }

        return $this->createDinosaur($codeName, $isCarnivorous, $length);
    }

    private function createDinosaur(string $genus, bool $isCarnivorous, int $length)
    {
        $dino = new Dinosaur($genus, $isCarnivorous);
        $dino->setLength($length);
        return $dino;
    }
}
