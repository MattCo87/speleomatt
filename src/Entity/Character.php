<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
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
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $attack;

    /**
     * @ORM\Column(type="integer")
     */
    private $defense;

    /**
     * @ORM\Column(type="integer")
     */
    private $resistance;

    /**
     * @ORM\Column(type="integer")
     */
    private $speed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ispremade;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="characters")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=CharacterFormation::class, mappedBy="characters")
     */
    private $characterFormations;

    /**
     * @ORM\OneToMany(targetEntity=CharacterStrategy::class, mappedBy="characters")
     */
    private $characterStrategies;

    public function __construct()
    {
        $this->characterFormations = new ArrayCollection();
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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(int $attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getResistance(): ?int
    {
        return $this->resistance;
    }

    public function setResistance(int $resistance): self
    {
        $this->resistance = $resistance;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getIspremade(): ?bool
    {
        return $this->ispremade;
    }

    public function setIspremade(bool $ispremade): self
    {
        $this->ispremade = $ispremade;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

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
            $characterFormation->setCharacters($this);
        }

        return $this;
    }

    public function removeCharacterFormation(CharacterFormation $characterFormation): self
    {
        if ($this->characterFormations->removeElement($characterFormation)) {
            // set the owning side to null (unless already changed)
            if ($characterFormation->getCharacters() === $this) {
                $characterFormation->setCharacters(null);
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
            $characterStrategy->setCharacters($this);
        }

        return $this;
    }

    public function removeCharacterStrategy(CharacterStrategy $characterStrategy): self
    {
        if ($this->characterStrategies->removeElement($characterStrategy)) {
            // set the owning side to null (unless already changed)
            if ($characterStrategy->getCharacters() === $this) {
                $characterStrategy->setCharacters(null);
            }
        }

        return $this;
    }

}
