<?php

namespace App\Entity;

use App\Repository\CharacterFormationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterFormationRepository::class)
 */
class CharacterFormation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=character::class, inversedBy="characterFormations")
     */
    private $characters;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="characterFormations")
     */
    private $formations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $positionCharacter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacters(): ?character
    {
        return $this->characters;
    }

    public function setCharacters(?character $characters): self
    {
        $this->characters = $characters;

        return $this;
    }

    public function getFormations(): ?Formation
    {
        return $this->formations;
    }

    public function setFormations(?Formation $formations): self
    {
        $this->formations = $formations;

        return $this;
    }

    public function getPositionCharacter(): ?string
    {
        return $this->positionCharacter;
    }

    public function setPositionCharacter(string $positionCharacter): self
    {
        $this->positionCharacter = $positionCharacter;

        return $this;
    }
}
