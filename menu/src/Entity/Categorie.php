<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Gerecht', mappedBy: 'categorie')]
    private $gerecht;

    public function __construct()
    {
        $this->gerecht = new ArrayCollection();
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

    /**
     * @return Collection<int, Gerecht>
     */
    public function getGerecht(): Collection
    {
        return $this->gerecht;
    }

    public function addGerecht(Gerecht $gerecht): self
    {
        if (!$this->gerecht->contains($gerecht)) {
            $this->gerecht[] = $gerecht;
            $gerecht->setCategorie($this);
        }

        return $this;
    }

    public function removeGerecht(Gerecht $gerecht): self
    {
        if ($this->gerecht->removeElement($gerecht)) {
            // set the owning side to null (unless already changed)
            if ($gerecht->getCategorie() === $this) {
                $gerecht->setCategorie(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
