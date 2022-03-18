<?php

namespace App\Entity;

use App\Repository\ActionStatregyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActionStatregyRepository::class)
 */
class ActionStatregy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=action::class, inversedBy="actionStatregies")
     */
    private $actions;

    /**
     * @ORM\ManyToOne(targetEntity=strategy::class, inversedBy="actionStatregies")
     */
    private $strategies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $positionAction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActions(): ?action
    {
        return $this->actions;
    }

    public function setActions(?action $actions): self
    {
        $this->actions = $actions;

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

    public function getPositionAction(): ?string
    {
        return $this->positionAction;
    }

    public function setPositionAction(?string $positionAction): self
    {
        $this->positionAction = $positionAction;

        return $this;
    }
}
