<?php

namespace App\Entity;

use App\Repository\CharacterStrategyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterStrategyRepository::class)
 */
class CharacterStrategy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Character::class, inversedBy="characterStrategies")
     */
    private $characters;

    /**
     * @ORM\ManyToOne(targetEntity=strategy::class, inversedBy="characterStrategies")
     */
    private $strategies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $positionStrategie;

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

    public function getStrategies(): ?strategy
    {
        return $this->strategies;
    }

    public function setStrategies(?strategy $strategies): self
    {
        $this->strategies = $strategies;

        return $this;
    }

    public function getPositionStrategie(): ?string
    {
        return $this->positionStrategie;
    }

    public function setPositionStrategie(?string $positionStrategie): self
    {
        $this->positionStrategie = $positionStrategie;

        return $this;
    }
}
