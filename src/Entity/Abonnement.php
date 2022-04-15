<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbonnementRepository::class)
 */
class Abonnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \User
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $id_user;

    /**
     * @var \Jeu
     * @ORM\ManyToOne(targetEntity=Jeu::class)
     * @ORM\JoinColumn(name="id_jeu", referencedColumnName="Id_Jeu")
     * })
     */
    private $id_jeu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdJeu(): ?Jeu
    {
        return $this->id_jeu;
    }

    public function setIdJeu(?Jeu $id_jeu): self
    {
        $this->id_jeu = $id_jeu;

        return $this;
    }
}
