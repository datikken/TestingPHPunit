<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use AppBundle\Exception\NotABuffetException;

class Enclosure
{
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Dinosaur", mappedBy="enclosure", cascade={"persist"})
     */
    private $dinosaurs;

    public function __construct()
    {
        $this->dinosaurs = new ArrayCollection();
    }

    public function getDinosaurs(): Collection
    {
        return $this->dinosaurs;
    }

    public function addDinosaur(Dinosaur $dino)
    {
        if (!$this->canAddDinosaur($dino)) {
            throw new NotABuffetException();
        }

        $this->dinosaurs[] = $dino;
    }

    public function canAddDinosaur(Dinosaur $dinosaur): bool
    {
        return count($this->dinosaurs) == 0 || $this->dinosaurs->first()->isCarnivorous() === $dinosaur->isCarnivorous();
    }
}
