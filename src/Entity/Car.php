<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 * @ApiResource(
 * normalizationContext={"group"={"read:car"}},
 * collectionOperations={"get"},
 * itemOperations={"get"})
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:car"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read:car"})
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * @Groups({"read:car"})
     */
    private $adDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read:car"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read:car"})
     */
    private $km;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read:car"})
     */
    private $year;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read:car"})
     */
    private $isSold;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:car"})
     */
    private $modele;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:car"})
     */
    private $garage;

    /**
     * @ORM\ManyToOne(targetEntity=Energy::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:car"})
     */
    private $energy;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="car")
     * @Groups({"read:car"})
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdDate(): ?\DateTimeInterface
    {
        return $this->adDate;
    }

    public function setAdDate(\DateTimeInterface $adDate): self
    {
        $this->adDate = $adDate;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(?int $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getIsSold(): ?bool
    {
        return $this->isSold;
    }

    public function setIsSold(bool $isSold): self
    {
        $this->isSold = $isSold;

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getEnergy(): ?Energy
    {
        return $this->energy;
    }

    public function setEnergy(?Energy $energy): self
    {
        $this->energy = $energy;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setCar($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCar() === $this) {
                $image->setCar(null);
            }
        }

        return $this;
    }
}
