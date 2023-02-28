<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
class Departement
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $ref = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\OneToMany(mappedBy: 'departement', targetEntity: Compture::class)]
    private Collection $c;

    public function __construct()
    {
        $this->c = new ArrayCollection();
    }

    public function getref(): ?int
    {
        return $this->ref;
    }
    public function setref(string $ref): self
    {
        $this->ref = $ref;

        return $this;
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, Compture>
     */
    public function getC(): Collection
    {
        return $this->c;
    }

    public function addC(Compture $c): self
    {
        if (!$this->c->contains($c)) {
            $this->c->add($c);
            $c->setDepartement($this);
        }

        return $this;
    }

    public function removeC(Compture $c): self
    {
        if ($this->c->removeElement($c)) {
            // set the owning side to null (unless already changed)
            if ($c->getDepartement() === $this) {
                $c->setDepartement(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
