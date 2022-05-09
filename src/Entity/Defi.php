<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Defi
 *
 * @ORM\Table(name="defi", uniqueConstraints={@ORM\UniqueConstraint(name="nom_defi", columns={"nom_Defi"})})
 * @ORM\Entity
 */
class Defi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Defi", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDefi;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_Defi", type="string", length=75, nullable=false)
     */
    private $nomDefi;

    /**
     * @var string
     *
     * @ORM\Column(name="Description_Defi", type="string", length=255, nullable=false)
     */
    private $descriptionDefi;

    /**
     * @var string
     *
     * @ORM\Column(name="img_Defi", type="text", length=0, nullable=false)
     */
    private $imgDefi;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_Defi", type="integer", nullable=false)
     */
    private $prixDefi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_Defi", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateDefi = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="jeu_Defi", type="string", length=100, nullable=false)
     */
    private $jeuDefi;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_equipe_Defi", type="integer", nullable=false)
     */
    private $nbrEquipeDefi;

    /**
     * @var string
     *
     * @ORM\Column(name="Régle_Defi", type="string", length=1000, nullable=false)
     */
    private $r�gleDefi;

    /**
     * @var string
     *
     * @ORM\Column(name="Recompense_Defi", type="string", length=255, nullable=false)
     */
    private $recompenseDefi;

    public function getIdDefi(): ?int
    {
        return $this->idDefi;
    }

    public function getNomDefi(): ?string
    {
        return $this->nomDefi;
    }

    public function setNomDefi(string $nomDefi): self
    {
        $this->nomDefi = $nomDefi;

        return $this;
    }

    public function getDescriptionDefi(): ?string
    {
        return $this->descriptionDefi;
    }

    public function setDescriptionDefi(string $descriptionDefi): self
    {
        $this->descriptionDefi = $descriptionDefi;

        return $this;
    }

    public function getImgDefi(): ?string
    {
        return $this->imgDefi;
    }

    public function setImgDefi(string $imgDefi): self
    {
        $this->imgDefi = $imgDefi;

        return $this;
    }

    public function getPrixDefi(): ?int
    {
        return $this->prixDefi;
    }

    public function setPrixDefi(int $prixDefi): self
    {
        $this->prixDefi = $prixDefi;

        return $this;
    }

    public function getDateDefi(): ?\DateTimeInterface
    {
        return $this->dateDefi;
    }

    public function setDateDefi(\DateTimeInterface $dateDefi): self
    {
        $this->dateDefi = $dateDefi;

        return $this;
    }

    public function getJeuDefi(): ?string
    {
        return $this->jeuDefi;
    }

    public function setJeuDefi(string $jeuDefi): self
    {
        $this->jeuDefi = $jeuDefi;

        return $this;
    }

    public function getNbrEquipeDefi(): ?int
    {
        return $this->nbrEquipeDefi;
    }

    public function setNbrEquipeDefi(int $nbrEquipeDefi): self
    {
        $this->nbrEquipeDefi = $nbrEquipeDefi;

        return $this;
    }

    public function getR�gleDefi(): ?string
    {
        return $this->r�gleDefi;
    }

    public function setR�gleDefi(string $r�gleDefi): self
    {
        $this->r�gleDefi = $r�gleDefi;

        return $this;
    }

    public function getRecompenseDefi(): ?string
    {
        return $this->recompenseDefi;
    }

    public function setRecompenseDefi(string $recompenseDefi): self
    {
        $this->recompenseDefi = $recompenseDefi;

        return $this;
    }
    public function __toString() {
        return $this->nomDefi;
    }

}
