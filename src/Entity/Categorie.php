<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categorie
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCat;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="nom_cat", type="string", length=100, nullable=false)
     */
    private $nomCat;

    public function getIdCat(): ?int
    {
        return $this->idCat;
    }

    public function getNomCat(): ?string
    {
        return $this->nomCat;
    }

    public function setNomCat(string $nomCat): self
    {
        $this->nomCat = $nomCat;

        return $this;
    }

    public function __toString():string {
        return $this->getNomCat();
    }


}
