<?php

namespace App\Entity;

use App\Repository\ImgsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImgsRepository::class)]
class Imgs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\ManyToMany(targetEntity: Room::class, mappedBy: 'pictures')]
    private $rooms;

    #[ORM\Column(type: 'boolean')]
    private $intro;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getUrl();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->addPicture($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            $room->removePicture($this);
        }

        return $this;
    }

    public function isIntro(): ?bool
    {
        return $this->intro;
    }

    public function setIntro(bool $intro): self
    {
        $this->intro = $intro;

        return $this;
    }
}
