<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StatisticsRepository::class)
 */
class Statistics
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $compteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompteur(): ?int
    {
        return $this->compteur;
    }

    public function setCompteur(int $compteur): self
    {
        $this->compteur = $compteur;

        return $this;
    }
}
