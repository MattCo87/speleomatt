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
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="characterFormations")
     */
    private $characters;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="characterFormations")
     */
    private $formations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $positionCharacter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacters(): ?Character
    {
        return $this->characters;
    }

    public function setCharacters(?Character $characters): self
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
