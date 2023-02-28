<?php

namespace App\Entity;

use App\Repository\ComptureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComptureRepository::class)]
class Compture
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $mat = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\ManyToOne(inversedBy: 'c')]
    #[ORM\JoinColumn(name: "dep_id", referencedColumnName: "ref")]
    private ?Departement $departement = null;

    public function getmat(): ?int
    {
        return $this->mat;
    }
    public function setmat(string $mat): self
    {
        $this->mat = $mat;

        return $this;
    }
    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }
}
