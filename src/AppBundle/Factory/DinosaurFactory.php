<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Dinosaur;
use AppBundle\Service\DinosaurLengthDeterminator;

class DinosaurFactory
{
    private $lengthDeterminator;

    public function __construct(DinosaurLengthDeterminator $lengthDeterminator)
    {
        $this->lengthDeterminator = $lengthDeterminator;
    }

    public function growVelociraptor(int $length): Dinosaur
    {
        $dino = new Dinosaur('Velociraptor', true);
        $dino->setLength($length);

        return $dino;
    }

    public function growFromSpecification(string $spec): Dinosaur
    {
        $codeName = 'InG-' . random_int(1, 9999);
        $length = $this->lengthDeterminator->getLengthFromSpecification($spec);
        $isCarnivorous = false;

        if(strpos($spec, 'carnivorous') !== false) {
            $isCarnivorous = true;
        }

        $dino = $this->createDinosaur($codeName, $isCarnivorous, $length);

        return $dino;
    }

    private function getLengthFromSpecification(string $specification): int
    {
        $availableLengths = [
            'huge' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'omg' => ['min' => Dinosaur::HUGE, 'max' => 100],
            '😱' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'large' => ['min' => Dinosaur::LARGE, 'max' => Dinosaur::HUGE - 1],
        ];
        $minLength = 1;
        $maxLength = Dinosaur::LARGE - 1;

        foreach (explode(' ', $specification) as $keyword) {
            $keyword = strtolower($keyword);

            if (array_key_exists($keyword, $availableLengths)) {
                $minLength = $availableLengths[$keyword]['min'];
                $maxLength = $availableLengths[$keyword]['max'];

                break;
            }
        }

        return random_int($minLength, $maxLength);
    }

    private function createDinosaur(string $genus, bool $isCarnivorous, int $length)
    {
        $dino = new Dinosaur($genus, $isCarnivorous);
        $dino->setLength($length);
        return $dino;
    }
}
