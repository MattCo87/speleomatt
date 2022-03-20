<?php

namespace App\Entity;

use App\Repository\ActionStrategyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActionStrategyRepository::class)
 */
class ActionStrategy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=action::class, inversedBy="actionStrategies",cascade={"persist"})
     */
    private $actions;

    /**
     * @ORM\ManyToOne(targetEntity=Strategy::class, inversedBy="actionStrategies",cascade={"persist"})
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

    public function getStrategies(): ?Strategy
    {
        return $this->strategies;
    }

    public function setStrategies(?Strategy $strategies): self
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
