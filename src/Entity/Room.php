<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: InformationsOfRooms::class)]
    private $informations;

    #[ORM\ManyToMany(targetEntity: Imgs::class, inversedBy: 'rooms')]
    private $pictures;

    #[ORM\Column(type: 'boolean')]
    private $isBest;

    #[ORM\Column(type: 'string', length: 255)]
    private $subtitle;

    #[ORM\ManyToMany(targetEntity: InformationsOfRooms::class, inversedBy: 'rooms')]
    private $infos;

    public function __construct()
    {
        $this->informations = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->infos = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Imgs>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Imgs $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
        }

        return $this;
    }

    public function removePicture(Imgs $picture): self
    {
        $this->pictures->removeElement($picture);

        return $this;
    }

    public function isIsBest(): ?bool
    {
        return $this->isBest;
    }

    public function setIsBest(bool $isBest): self
    {
        $this->isBest = $isBest;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * @return Collection<int, InformationsOfRooms>
     */
    public function getInfos(): Collection
    {
        return $this->infos;
    }

    public function addInfo(InformationsOfRooms $info): self
    {
        if (!$this->infos->contains($info)) {
            $this->infos[] = $info;
        }

        return $this;
    }

    public function removeInfo(InformationsOfRooms $info): self
    {
        $this->infos->removeElement($info);

        return $this;
    }
}
