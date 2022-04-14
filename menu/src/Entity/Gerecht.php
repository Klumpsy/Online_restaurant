<?php

namespace App\Entity;

use App\Repository\GerechtRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GerechtRepository::class)]
class Gerecht
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $gerecht;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $beschrijving;

    #[ORM\Column(type: 'float', nullable: true)]
    private $Prijs;

    #[ORM\Column(type: 'string', length: 225, nullable: true)]
    private $image;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Categorie', inversedBy: 'gerecht')]
    private $categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGerecht(): ?string
    {
        return $this->gerecht;
    }

    public function setGerecht(string $gerecht): self
    {
        $this->gerecht = $gerecht;

        return $this;
    }

    public function getBeschrijving(): ?string
    {
        return $this->beschrijving;
    }

    public function setBeschrijving(?string $beschrijving): self
    {
        $this->beschrijving = $beschrijving;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->Prijs;
    }

    public function setPrijs(?float $Prijs): self
    {
        $this->Prijs = $Prijs;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
