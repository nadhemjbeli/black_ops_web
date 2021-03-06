<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Jeu
 *
 * @ORM\Table(name="jeu", indexes={@ORM\Index(name="id_souscat", columns={"id_souscat"})})
 * @ORM\Entity
 */
class Jeu
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Jeu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idJeu;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length (
     * min="3",
     * minMessage="Entrer un nom au minimum de 3 caractères"
     * )
     * @ORM\Column(name="Nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length (
     * min="3",
     * minMessage="Entrer un description du jeu au minimum de 3 caractères"
     * )
     * @ORM\Column(name="description", type="text", length=0, nullable=false)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length (
     * min="3",
     * minMessage="Entrer un url au minimum de 3 caractères"
     * )
     * @ORM\Column(name="Url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var \SousCategorie
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="SousCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_souscat", referencedColumnName="id_SousCat")
     * })
     */
    private $idSouscat;

    public function getIdJeu(): ?int
    {
        return $this->idJeu;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIdSouscat(): ?SousCategorie
    {
        return $this->idSouscat;
    }

    public function setIdSouscat(?SousCategorie $idSouscat): self
    {
        $this->idSouscat = $idSouscat;

        return $this;
    }
    public function __toString():string {
        return $this->getNom();
    }
}
