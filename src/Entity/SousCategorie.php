<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousCategorie
 * @ORM\Entity(repositoryClass="App\Repository\SousCategorieRepository")
 * @ORM\Table(name="sous_categorie", indexes={@ORM\Index(name="id_cat", columns={"id_cat"})})
 * @ORM\Entity
 */
class SousCategorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_SousCat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSouscat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_SousCat", type="string", length=255, nullable=true)
     */
    private $nomSouscat;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_cat", type="integer", nullable=true)
     */
    private $idCat;

    public function getIdSouscat(): ?int
    {
        return $this->idSouscat;
    }

    public function getNomSouscat(): ?string
    {
        return $this->nomSouscat;
    }

    public function setNomSouscat(?string $nomSouscat): self
    {
        $this->nomSouscat = $nomSouscat;

        return $this;
    }

    public function getIdCat(): ?int
    {
        return $this->idCat;
    }

    public function setIdCat(?int $idCat): self
    {
        $this->idCat = $idCat;

        return $this;
    }

    public function __toString():string {
        return $this->getNomSouscat();
    }


}
