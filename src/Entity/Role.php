<?php

namespace App\Entity;

use App\Repository\ROLERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ROLERepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $ROLE = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getROLE(): ?string
    {
        return $this->ROLE;
    }

    public function setROLE(string $ROLE): static
    {
        $this->ROLE = $ROLE;

        return $this;
    }
}
