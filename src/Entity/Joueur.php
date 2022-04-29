<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Joueur
 *
 * @ORM\Table(name="joueur", indexes={@ORM\Index(name="id_equipe", columns={"id_equipe"}), @ORM\Index(name="user_joueur", columns={"id_user"})})
 * @ORM\Entity
 */
class Joueur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Joueur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idJoueur;

    /**
     * @var string
     *@Assert\NotBlank
     * @ORM\Column(name="nom_Joueur", type="string", length=50, nullable=false)
     */
    private $nomJoueur;

    /**
     * @var string
     *@Assert\NotBlank
     * @ORM\Column(name="rang_Joueur", type="string", length=50, nullable=false)
     */
    private $rangJoueur;

    /**
     * @var string
     *@Assert\NotBlank
     * @ORM\Column(name="Pseaudo_Joueur", type="string", length=25, nullable=false)
     */
    private $pseaudoJoueur;

    /**
     * @var \User
     *@Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    /**
     * @var \Equipe
     *@Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_equipe", referencedColumnName="id_Equipe")
     * })
     */
    private $idEquipe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Tel;

    public function getIdJoueur(): ?int
    {
        return $this->idJoueur;
    }

    public function getNomJoueur(): ?string
    {
        return $this->nomJoueur;
    }

    public function setNomJoueur(string $nomJoueur): self
    {
        $this->nomJoueur = $nomJoueur;

        return $this;
    }

    public function getRangJoueur(): ?string
    {
        return $this->rangJoueur;
    }

    public function setRangJoueur(string $rangJoueur): self
    {
        $this->rangJoueur = $rangJoueur;

        return $this;
    }

    public function getPseaudoJoueur(): ?string
    {
        return $this->pseaudoJoueur;
    }

    public function setPseaudoJoueur(string $pseaudoJoueur): self
    {
        $this->pseaudoJoueur = $pseaudoJoueur;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdEquipe(): ?Equipe
    {
        return $this->idEquipe;
    }

    public function setIdEquipe(?Equipe $idEquipe): self
    {
        $this->idEquipe = $idEquipe;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(?string $Tel): self
    {
        $this->Tel = $Tel;

        return $this;
    }


}
