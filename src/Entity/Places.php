<?php

namespace App\Entity;

use App\Repository\PlacesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlacesRepository::class)
 */
class Places
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Cities::class, inversedBy="places")
     * @ORM\JoinColumn(nullable=false)
     */
    private $citie;

    /**
     * @ORM\ManyToMany(targetEntity=Festivals::class, inversedBy="places")
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

    public function getCitie(): ?Cities
    {
        return $this->citie;
    }

    public function setCitie(?Cities $citie): self
    {
        $this->citie = $citie;

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
        }

        return $this;
    }

    public function removeFestival(Festivals $festival): self
    {
        $this->festival->removeElement($festival);

        return $this;
    }
}