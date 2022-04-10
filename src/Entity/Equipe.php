<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity
 */
class Equipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Equipe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEquipe;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_Equipe", type="string", length=100, nullable=false)
     */
    private $nomEquipe;

    /**
     * @var string
     *
     * @ORM\Column(name="logo_Equipe", type="text", length=0, nullable=false)
     */
    private $logoEquipe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $date ;

    /**
     * @var int
     *@Assert\NotBlank
     * @ORM\Column(name="nbr_joueur_Equipe", type="integer", nullable=false)
     */
    private $nbrJoueurEquipe;



    /**
     * @var \Jeu
     *
     * @ORM\ManyToOne(targetEntity="Jeu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="JeuV", referencedColumnName="Id_Jeu")
     * })
     */
    private $JeuV;


    public function getIdEquipe(): ?int
    {
        return $this->idEquipe;
    }

    public function getNomEquipe(): ?string
    {
        return $this->nomEquipe;
    }

    public function setNomEquipe(string $nomEquipe): self
    {
        $this->nomEquipe = $nomEquipe;

        return $this;
    }

    public function getLogoEquipe()
    {
        return $this->logoEquipe;
    }

    public function setLogoEquipe($logoEquipe)
    {
        $this->logoEquipe = $logoEquipe;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

//    public function setDate(\DateTimeInterface $date): self
//    {
//        $this->date = $date;
//
//        return $this;
//    }

    public function getNbrJoueurEquipe(): ?int
    {
        return $this->nbrJoueurEquipe;
    }

    public function setNbrJoueurEquipe(int $nbrJoueurEquipe): self
    {
        $this->nbrJoueurEquipe = $nbrJoueurEquipe;

        return $this;
    }

    public function __toString() : String
    {
        return $this->getNomEquipe();
    }



    public function getJeuV(): ?Jeu
    {
        return $this->JeuV;
    }

    public function setJeuV(?Jeu $JeuV): self
    {
        $this->JeuV = $JeuV;

        return $this;
    }


}
