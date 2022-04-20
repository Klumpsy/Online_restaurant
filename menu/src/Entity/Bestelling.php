<?php

namespace App\Entity;

use App\Repository\BestellingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BestellingRepository::class)]
class Bestelling
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $gerecht;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bestelnummer;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    private $prijs;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGerecht(): ?string
    {
        return $this->gerecht;
    }

    public function setGerecht(?string $gerecht): self
    {
        $this->gerecht = $gerecht;

        return $this;
    }

    public function getBestelnummer(): ?string
    {
        return $this->bestelnummer;
    }

    public function setBestelnummer(?string $bestelnummer): self
    {
        $this->bestelnummer = $bestelnummer;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrijs(): ?string
    {
        return $this->prijs;
    }

    public function setPrijs(?string $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
