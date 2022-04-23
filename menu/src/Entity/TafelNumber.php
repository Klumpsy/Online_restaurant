<?php

namespace App\Entity;

use App\Repository\TafelNumberRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TafelNumberRepository::class)]
class TafelNumber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string')]
    private $Tafelnr;

    #[ORM\Column(type: 'string')]
    private $persons;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTafelnr(): ?string
    {
        return $this->Tafelnr;
    }

    public function setTafelnr(string $Tafelnr): self
    {
        $this->Tafelnr = $Tafelnr;

        return $this;
    }

    public function getPersons(): ?string
    {
        return $this->persons;
    }

    public function setPersons(string $persons): self
    {
        $this->persons = $persons;

        return $this;
    }
}
