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
}
