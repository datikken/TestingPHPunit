<?php

namespace AppBundle\Entity;

use AppBundle\Exception\DinosAreRunningRampantException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use AppBundle\Exception\NotABuffetException;

class Enclosure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Dinosaur", mappedBy="enclosure", cascade={"persist"})
     */
    private $dinosaurs;

    /**
     * @var Collection|Security[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Security", mappedBy="enclosure", cascade={"persist"})
     */
    private $securities;

    public function __construct(bool $withBasicSecurity = false)
    {
        $this->dinosaurs = new ArrayCollection();
        $this->securities = new ArrayCollection();

        if ($withBasicSecurity) {
            $this->addSecurity(new Security('Fence', true, $this));
        }
    }

    public function addSecurity(Security $security)
    {
        $this->securities[] = $security;
    }

    public function getSecurities(): Collection
    {
        return $this->securities;
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
        if(!$this->isSecurityActive()) {
            throw new DinosAreRunningRampantException('Are you crazy?');
        }

        $this->dinosaurs[] = $dino;
    }

    public function isSecurityActive(): bool
    {
        foreach ($this->securities as $security) {
            if ($security->getIsActive()) {
                return true;
            }
        }

        return false;
    }

    public function canAddDinosaur(Dinosaur $dinosaur): bool
    {
        return count($this->dinosaurs) == 0 || $this->dinosaurs->first()->isCarnivorous() === $dinosaur->isCarnivorous();
    }
}
