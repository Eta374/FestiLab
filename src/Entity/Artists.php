<?php

namespace App\Entity;

use App\Repository\ArtistsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtistsRepository::class)
 */
class Artists
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripton;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $socialLink;

    /**
     * @ORM\ManyToMany(targetEntity=Festivals::class, inversedBy="artists")
     */
    private $festival;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

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

    public function getDescripton(): ?string
    {
        return $this->descripton;
    }

    public function setDescripton(?string $descripton): self
    {
        $this->descripton = $descripton;

        return $this;
    }

    public function getSocialLink(): ?string
    {
        return $this->socialLink;
    }

    public function setSocialLink(string $socialLink): self
    {
        $this->socialLink = $socialLink;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
