<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelRepository::class)]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $model = null;

    /**
     * @var Collection<int, Voiture>
     */
    #[ORM\OneToMany(targetEntity: Voiture::class, mappedBy: 'id_Model')]
    private Collection $C;

    /**
     * @var Collection<int, Marque>
     */
    #[ORM\OneToMany(targetEntity: Marque::class, mappedBy: 'model')]
    private Collection $marque;

    /**
     * @var Collection<int, Marque>
     */
    #[ORM\OneToMany(targetEntity: Marque::class, mappedBy: 'model')]
    private Collection $idMarque;

    public function __construct()
    {
        $this->C = new ArrayCollection();
        $this->marque = new ArrayCollection();
        $this->idMarque = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getC(): Collection
    {
        return $this->C;
    }

    public function addC(Voiture $c): static
    {
        if (!$this->C->contains($c)) {
            $this->C->add($c);
            $c->setIdModel($this);
        }

        return $this;
    }

    public function removeC(Voiture $c): static
    {
        if ($this->C->removeElement($c)) {
            // set the owning side to null (unless already changed)
            if ($c->getIdModel() === $this) {
                $c->setIdModel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Marque>
     */
    public function getMarque(): Collection
    {
        return $this->marque;
    }

    public function addMarque(Marque $marque): static
    {
        if (!$this->marque->contains($marque)) {
            $this->marque->add($marque);
            $marque->setModel($this);
        }

        return $this;
    }

    public function removeMarque(Marque $marque): static
    {
        if ($this->marque->removeElement($marque)) {
            // set the owning side to null (unless already changed)
            if ($marque->getModel() === $this) {
                $marque->setModel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Marque>
     */
    public function getIdMarque(): Collection
    {
        return $this->idMarque;
    }

    public function addIdMarque(Marque $idMarque): static
    {
        if (!$this->idMarque->contains($idMarque)) {
            $this->idMarque->add($idMarque);
            $idMarque->setModel($this);
        }

        return $this;
    }

    public function removeIdMarque(Marque $idMarque): static
    {
        if ($this->idMarque->removeElement($idMarque)) {
            // set the owning side to null (unless already changed)
            if ($idMarque->getModel() === $this) {
                $idMarque->setModel(null);
            }
        }

        return $this;
    }
}
