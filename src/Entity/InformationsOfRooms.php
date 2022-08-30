<?php

namespace App\Entity;

use App\Repository\InformationsOfRoomsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InformationsOfRoomsRepository::class)]
class InformationsOfRooms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $size;

    #[ORM\Column(type: 'string', length: 255)]
    private $bed;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $outside;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tools;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tv;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $foods;

    #[ORM\Column(type: 'string', length: 255)]
    private $capacity;

    #[ORM\Column(type: 'string', length: 255)]
    private $internet;

    #[ORM\Column(type: 'string', length: 255)]
    private $bathroom;

    #[ORM\Column(type: 'string', length: 255)]
    private $cooling;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $shortDrinks;

    #[ORM\ManyToMany(targetEntity: Room::class, mappedBy: 'infos')]
    private $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function __toString(): string
    {
        return
            $this->getBed() .
            $this->getBathroom() .
            $this->getCapacity() .
            $this->getCooling() .
            $this->getFoods() .
            $this->getInternet() .
            $this->getOutside() .
            $this->getShortDrinks() .
            $this->getSize() .
            $this->getTools() .
            $this->getTv();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getBed(): ?string
    {
        return $this->bed;
    }

    public function setBed(string $bed): self
    {
        $this->bed = $bed;

        return $this;
    }

    public function getOutside(): ?string
    {
        return $this->outside;
    }

    public function setOutside(?string $outside): self
    {
        $this->outside = $outside;

        return $this;
    }

    public function getTools(): ?string
    {
        return $this->tools;
    }

    public function setTools(?string $tools): self
    {
        $this->tools = $tools;

        return $this;
    }

    public function getTv(): ?string
    {
        return $this->tv;
    }

    public function setTv(?string $tv): self
    {
        $this->tv = $tv;

        return $this;
    }

    public function getFoods(): ?string
    {
        return $this->foods;
    }

    public function setFoods(?string $foods): self
    {
        $this->foods = $foods;

        return $this;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getInternet(): ?string
    {
        return $this->internet;
    }

    public function setInternet(string $internet): self
    {
        $this->internet = $internet;

        return $this;
    }

    public function getBathroom(): ?string
    {
        return $this->bathroom;
    }

    public function setBathroom(string $bathroom): self
    {
        $this->bathroom = $bathroom;

        return $this;
    }

    public function getCooling(): ?string
    {
        return $this->cooling;
    }

    public function setCooling(string $cooling): self
    {
        $this->cooling = $cooling;

        return $this;
    }

    public function getShortDrinks(): ?string
    {
        return $this->shortDrinks;
    }

    public function setShortDrinks(?string $shortDrinks): self
    {
        $this->shortDrinks = $shortDrinks;

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
            $room->addInfo($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            $room->removeInfo($this);
        }

        return $this;
    }
}
