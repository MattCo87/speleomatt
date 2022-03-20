<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActionRepository::class)
 */
class Action
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
     * @ORM\Column(type="integer")
     */
    private $power;

    /**
     * @ORM\OneToMany(targetEntity=ActionStrategy::class, mappedBy="actions")
     */
    private $actionStrategies;

    public function __construct()
    {
        $this->actionStrategies = new ArrayCollection();
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

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): self
    {
        $this->power = $power;

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
            $actionStrategy->setActions($this);
        }

        return $this;
    }

    public function removeActionStrategy(ActionStrategy $actionStrategy): self
    {
        if ($this->actionStrategies->removeElement($actionStrategy)) {
            // set the owning side to null (unless already changed)
            if ($actionStrategy->getActions() === $this) {
                $actionStrategy->setActions(null);
            }
        }

        return $this;
    }
}
