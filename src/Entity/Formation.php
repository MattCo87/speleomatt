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
     * @ORM\ManyToMany(targetEntity=Fight::class, inversedBy="formations")
     */
    private $fights;

    /**
     * @ORM\OneToMany(targetEntity=CharacterFormation::class, mappedBy="formations",cascade={"persist"})
     */
    private $characterFormations;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="formations")
     */
    private $user;

    public function __construct()
    {
        $this->fights = new ArrayCollection();
        $this->characterFormations = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * @return Collection<int, Fight>
     */
    public function getFights(): Collection
    {
        return $this->fights;
    }

    public function addFight(Fight $fight): self
    {
        if (!$this->fights->contains($fight)) {
            $this->fights[] = $fight;
        }

        return $this;
    }

    public function removeFight(Fight $fight): self
    {
        $this->fights->removeElement($fight);

        return $this;
    }

    /**
     * @return Collection<int, CharacterFormation>
     */
    public function getCharacterFormations(): Collection
    {
        return $this->characterFormations;
    }

    public function addCharacterFormation(CharacterFormation $characterFormation): self
    {
        if (!$this->characterFormations->contains($characterFormation)) {
            $this->characterFormations[] = $characterFormation;
            $characterFormation->setFormations($this);
        }

        return $this;
    }

    public function removeCharacterFormation(CharacterFormation $characterFormation): self
    {
        if ($this->characterFormations->removeElement($characterFormation)) {
            // set the owning side to null (unless already changed)
            if ($characterFormation->getFormations() === $this) {
                $characterFormation->setFormations(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
