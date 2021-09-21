<?php

namespace App\Entity;

use App\Repository\FestivalsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FestivalsRepository::class)
 */
class Festivals
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $websiteLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ticketOfficeLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $socialLink;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tdg;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modifiedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Places::class, mappedBy="festival")
     */
    private $places;

    /**
     * @ORM\ManyToOne(targetEntity=Kinds::class, inversedBy="festival")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kind;

    /**
     * @ORM\ManyToOne(targetEntity=Publics::class, inversedBy="festival")
     * @ORM\JoinColumn(nullable=false)
     */
    private $public;

    /**
     * @ORM\ManyToMany(targetEntity=Artists::class, mappedBy="festival")
     */
    private $artists;

    /**
     * @ORM\OneToMany(targetEntity=News::class, mappedBy="festival")
     */
    private $news;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="festival")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Editor;

    /**
     * @ORM\OneToMany(targetEntity=Pictures::class, mappedBy="festival")
     */
    private $pictures;

    public function __construct()
    {
        $this->places = new ArrayCollection();
        $this->artists = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getWebsiteLink(): ?string
    {
        return $this->websiteLink;
    }

    public function setWebsiteLink(?string $websiteLink): self
    {
        $this->websiteLink = $websiteLink;

        return $this;
    }

    public function getTicketOfficeLink(): ?string
    {
        return $this->ticketOfficeLink;
    }

    public function setTicketOfficeLink(?string $ticketOfficeLink): self
    {
        $this->ticketOfficeLink = $ticketOfficeLink;

        return $this;
    }

    public function getSocialLink(): ?string
    {
        return $this->socialLink;
    }

    public function setSocialLink(?string $socialLink): self
    {
        $this->socialLink = $socialLink;

        return $this;
    }

    public function getTdg(): ?bool
    {
        return $this->tdg;
    }

    public function setTdg(bool $tdg): self
    {
        $this->tdg = $tdg;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

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
            $place->addFestival($this);
        }

        return $this;
    }

    public function removePlace(Places $place): self
    {
        if ($this->places->removeElement($place)) {
            $place->removeFestival($this);
        }

        return $this;
    }

    public function getKind(): ?Kinds
    {
        return $this->kind;
    }

    public function setKind(?Kinds $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function getPublic(): ?Publics
    {
        return $this->public;
    }

    public function setPublic(?Publics $public): self
    {
        $this->public = $public;

        return $this;
    }

    /**
     * @return Collection|Artists[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artists $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
            $artist->addFestival($this);
        }

        return $this;
    }

    public function removeArtist(Artists $artist): self
    {
        if ($this->artists->removeElement($artist)) {
            $artist->removeFestival($this);
        }

        return $this;
    }

    /**
     * @return Collection|News[]
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
            $news->setFestival($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->removeElement($news)) {
            // set the owning side to null (unless already changed)
            if ($news->getFestival() === $this) {
                $news->setFestival(null);
            }
        }

        return $this;
    }

    public function getEditor(): ?User
    {
        return $this->Editor;
    }

    public function setEditor(?User $Editor): self
    {
        $this->Editor = $Editor;

        return $this;
    }

    /**
     * @return Collection|Pictures[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setFestival($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getFestival() === $this) {
                $picture->setFestival(null);
            }
        }

        return $this;
    }
}
