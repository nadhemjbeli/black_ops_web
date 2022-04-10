<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Defi
 *
 * @ORM\Table(name="defi", uniqueConstraints={@ORM\UniqueConstraint(name="nom_defi", columns={"nom_Defi"})}, indexes={@ORM\Index(name="defi_jeu", columns={"jeu_Defi"})})
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
     * @Assert\NotBlank
     * @ORM\Column(name="nom_Defi", type="string", length=75, nullable=false)
     */
    private $nomDefi;

    /**
     * @var string
     *@Assert\NotBlank
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
     * @Assert\NotBlank
     * @ORM\Column(name="prix_Defi", type="integer", nullable=false)
     */
    private $prixDefi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_Defi", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateDefi ;

    /**
     * @var int
     * @Assert\NotBlank
     * @ORM\Column(name="nbr_equipe_Defi", type="integer", nullable=false)
     */
    private $nbrEquipeDefi;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="Regle_Defi", type="string", length=1000, nullable=false)
     */
    private $regleDefi;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="Recompense_Defi", type="string", length=255, nullable=false)
     */
    private $recompenseDefi;

    /**
     * @var \Jeu
     *
     * @ORM\ManyToOne(targetEntity="Jeu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jeu_Defi", referencedColumnName="Id_Jeu")
     * })
     */
    private $jeuDefi;

    private $file;

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

    public function getImgDefi()
    {
        return $this->imgDefi;
    }

    public function setImgDefi( $imgDefi)
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

//    public function setDateDefi(\DateTimeInterface $dateDefi): self
//    {
//        $this->dateDefi = $dateDefi;
//
//        return $this;
//    }

    public function getNbrEquipeDefi(): ?int
    {
        return $this->nbrEquipeDefi;
    }

    public function setNbrEquipeDefi(int $nbrEquipeDefi): self
    {
        $this->nbrEquipeDefi = $nbrEquipeDefi;

        return $this;
    }

    public function getRegleDefi(): ?string
    {
        return $this->regleDefi;
    }

    public function setRegleDefi(string $regleDefi): self
    {
        $this->regleDefi = $regleDefi;

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

    public function getJeuDefi(): ?Jeu
    {
        return $this->jeuDefi;
    }

    public function setJeuDefi(?Jeu $jeuDefi): self
    {
        $this->jeuDefi = $jeuDefi;

        return $this;
    }

    public function __toString() : String
    {
        return $this->getNomDefi();
    }


    public function getFile()
    {
        return $this->file;
    }


    public function setFile($file): void
    {
        $this->file = $file;
    }


}
