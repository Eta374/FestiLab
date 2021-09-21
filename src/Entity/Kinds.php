<?php

namespace App\Entity;

use App\Repository\KindsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KindsRepository::class)
 */
class Kinds
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
     * @ORM\OneToMany(targetEntity=Festivals::class, mappedBy="kind")
     */
    private $festival;

    public function __construct()
    {
        $this->festival = new ArrayCollection();
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
     * @return Collection|Festivals[]
     */
    public function getFestival(): Collection
    {
        return $this->festival;
    }

    public function addFestival(Festivals $festival): self
    {
        if (!$this->festival->contains($festival)) {
            $this->festival[] = $festival;
            $festival->setKind($this);
        }

        return $this;
    }

    public function removeFestival(Festivals $festival): self
    {
        if ($this->festival->removeElement($festival)) {
            // set the owning side to null (unless already changed)
            if ($festival->getKind() === $this) {
                $festival->setKind(null);
            }
        }

        return $this;
    }
}
