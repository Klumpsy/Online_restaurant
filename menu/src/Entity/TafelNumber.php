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

    #[ORM\Column(type: 'string', length: 255)]
    private $status;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
