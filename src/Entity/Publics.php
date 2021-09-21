<?php

namespace App\Entity;

use App\Repository\PublicsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PublicsRepository::class)
 */
class Publics
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
    private $types;

    /**
     * @ORM\OneToMany(targetEntity=Festivals::class, mappedBy="public")
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

    public function getTypes(): ?string
    {
        return $this->types;
    }

    public function setTypes(string $types): self
    {
        $this->types = $types;

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
            $festival->setPublic($this);
        }

        return $this;
    }

    public function removeFestival(Festivals $festival): self
    {
        if ($this->festival->removeElement($festival)) {
            // set the owning side to null (unless already changed)
            if ($festival->getPublic() === $this) {
                $festival->setPublic(null);
            }
        }

        return $this;
    }


}
