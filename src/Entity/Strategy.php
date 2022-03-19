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
     * @ORM\OneToMany(targetEntity=ActionStrategy::class, mappedBy="strategies")
     */
    private $actionStrategies;

    /**
     * @ORM\OneToMany(targetEntity=CharacterStrategy::class, mappedBy="strategies")
     */
    private $characterStrategies;

    public function __construct()
    {
        $this->actionStrategies = new ArrayCollection();
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
     * @return Collection<int, ActionStrategy>
     */
    public function getActionStatregies(): Collection
    {
        return $this->actionStrategies;
    }

    public function addActionStrategy(ActionStrategy $actionStrategy): self
    {
        if (!$this->actionStrategies->contains($actionStrategy)) {
            $this->actionStrategies[] = $actionStrategy;
            $actionStrategy->setStrategies($this);
        }

        return $this;
    }

    public function removeActionStrategy(ActionStrategy $actionStrategy): self
    {
        if ($this->actionStrategies->removeElement($actionStrategy)) {
            // set the owning side to null (unless already changed)
            if ($actionStrategy->getStrategies() === $this) {
                $actionStrategy->setStrategies(null);
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
