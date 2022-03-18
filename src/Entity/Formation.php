<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
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
     * @ORM\ManyToMany(targetEntity=fight::class, inversedBy="formations")
     */
    private $fights;

    public function __construct()
    {
        $this->fights = new ArrayCollection();
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
     * @return Collection<int, fight>
     */
    public function getFights(): Collection
    {
        return $this->fights;
    }

    public function addFight(fight $fight): self
    {
        if (!$this->fights->contains($fight)) {
            $this->fights[] = $fight;
        }

        return $this;
    }

    public function removeFight(fight $fight): self
    {
        $this->fights->removeElement($fight);

        return $this;
    }
}
