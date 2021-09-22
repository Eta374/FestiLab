<?php

namespace App\Entity;

use App\Entity\Places;
use App\Entity\Departments;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CitiesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CitiesRepository::class)
 */
class Cities
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity=Departments::class, inversedBy="cities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $department;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameUppercase;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameSimple;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameReal;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=0)
     */
    private $zip;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=5)
     */
    private $longitudeDeg;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=5)
     */
    private $latitudeDeg;

    /**
     * @ORM\OneToMany(targetEntity=Places::class, mappedBy="citie")
     */
    private $places;

    public function __construct()
    {
        $this->places = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartment(): ?departments
    {
        return $this->department;
    }

    public function setDepartment(?departments $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getNameUppercase(): ?string
    {
        return $this->nameUppercase;
    }

    public function setNameUppercase(string $nameUppercase): self
    {
        $this->nameUppercase = $nameUppercase;

        return $this;
    }

    public function getNameSimple(): ?string
    {
        return $this->nameSimple;
    }

    public function setNameSimple(string $nameSimple): self
    {
        $this->nameSimple = $nameSimple;

        return $this;
    }

    public function getNameReal(): ?string
    {
        return $this->nameReal;
    }

    public function setNameReal(string $nameReal): self
    {
        $this->nameReal = $nameReal;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getLongitudeDeg(): ?string
    {
        return $this->longitudeDeg;
    }

    public function setLongitudeDeg(string $longitudeDeg): self
    {
        $this->longitudeDeg = $longitudeDeg;

        return $this;
    }

    public function getLatitudeDeg(): ?string
    {
        return $this->latitudeDeg;
    }

    public function setLatitudeDeg(string $latitudeDeg): self
    {
        $this->latitudeDeg = $latitudeDeg;

        return $this;
    }

    /**
     * @return Collection|Places[]
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(Places $place): self
    {
        if (!$this->places->contains($place)) {
            $this->places[] = $place;
            $place->setCitie($this);
        }

        return $this;
    }

    public function removePlace(Places $place): self
    {
        if ($this->places->removeElement($place)) {
            // set the owning side to null (unless already changed)
            if ($place->getCitie() === $this) {
                $place->setCitie(null);
            }
        }

        return $this;
    }
}
