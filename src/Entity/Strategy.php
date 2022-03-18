<?php

namespace App\Entity;

use App\Repository\StrategyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StrategyRepository::class)
 */
class Strategy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ActionStatregy::class, mappedBy="strategies")
     */
    private $actionStatregies;

    /**
     * @ORM\OneToMany(targetEntity=CharacterStrategy::class, mappedBy="strategies")
     */
    private $characterStrategies;

    public function __construct()
    {
        $this->actionStatregies = new ArrayCollection();
        $this->characterStrategies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, ActionStatregy>
     */
    public function getActionStatregies(): Collection
    {
        return $this->actionStatregies;
    }

    public function addActionStatregy(ActionStatregy $actionStatregy): self
    {
        if (!$this->actionStatregies->contains($actionStatregy)) {
            $this->actionStatregies[] = $actionStatregy;
            $actionStatregy->setStrategies($this);
        }

        return $this;
    }

    public function removeActionStatregy(ActionStatregy $actionStatregy): self
    {
        if ($this->actionStatregies->removeElement($actionStatregy)) {
            // set the owning side to null (unless already changed)
            if ($actionStatregy->getStrategies() === $this) {
                $actionStatregy->setStrategies(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CharacterStrategy>
     */
    public function getCharacterStrategies(): Collection
    {
        return $this->characterStrategies;
    }

    public function addCharacterStrategy(CharacterStrategy $characterStrategy): self
    {
        if (!$this->characterStrategies->contains($characterStrategy)) {
            $this->characterStrategies[] = $characterStrategy;
            $characterStrategy->setStrategies($this);
        }

        return $this;
    }

    public function removeCharacterStrategy(CharacterStrategy $characterStrategy): self
    {
        if ($this->characterStrategies->removeElement($characterStrategy)) {
            // set the owning side to null (unless already changed)
            if ($characterStrategy->getStrategies() === $this) {
                $characterStrategy->setStrategies(null);
            }
        }

        return $this;
    }
}
