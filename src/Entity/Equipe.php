<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
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

    public function getLogoEquipe(): ?string
    {
        return $this->logoEquipe;
    }

    public function setLogoEquipe(string $logoEquipe): self
    {
        $this->logoEquipe = $logoEquipe;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbrJoueurEquipe(): ?int
    {
        return $this->nbrJoueurEquipe;
    }

    public function setNbrJoueurEquipe(int $nbrJoueurEquipe): self
    {
        $this->nbrJoueurEquipe = $nbrJoueurEquipe;

        return $this;
    }


}
