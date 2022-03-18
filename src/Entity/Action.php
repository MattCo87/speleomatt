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
     * @ORM\OneToMany(targetEntity=ActionStatregy::class, mappedBy="actions")
     */
    private $actionStatregies;

    public function __construct()
    {
        $this->actionStatregies = new ArrayCollection();
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
            $actionStatregy->setActions($this);
        }

        return $this;
    }

    public function removeActionStatregy(ActionStatregy $actionStatregy): self
    {
        if ($this->actionStatregies->removeElement($actionStatregy)) {
            // set the owning side to null (unless already changed)
            if ($actionStatregy->getActions() === $this) {
                $actionStatregy->setActions(null);
            }
        }

        return $this;
    }
}
