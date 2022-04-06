<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignecommande
 *
 * @ORM\Table(name="lignecommande", indexes={@ORM\Index(name="id_defi", columns={"id_defi"}), @ORM\Index(name="id_commande", columns={"id_commande"})})
 * @ORM\Entity
 */
class Lignecommande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_LigneCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLignecommande;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite_Billet", type="integer", nullable=false)
     */
    private $quantiteBillet;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_Billet", type="integer", nullable=false)
     */
    private $prixBillet;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_commande", referencedColumnName="id_Commande")
     * })
     */
    private $idCommande;

    /**
     * @var \Defi
     *
     * @ORM\ManyToOne(targetEntity="Defi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_defi", referencedColumnName="id_Defi")
     * })
     */
    private $idDefi;

    public function getIdLignecommande(): ?int
    {
        return $this->idLignecommande;
    }

    public function getQuantiteBillet(): ?int
    {
        return $this->quantiteBillet;
    }

    public function setQuantiteBillet(int $quantiteBillet): self
    {
        $this->quantiteBillet = $quantiteBillet;

        return $this;
    }

    public function getPrixBillet(): ?int
    {
        return $this->prixBillet;
    }

    public function setPrixBillet(int $prixBillet): self
    {
        $this->prixBillet = $prixBillet;

        return $this;
    }

    public function getIdCommande(): ?Commande
    {
        return $this->idCommande;
    }

    public function setIdCommande(?Commande $idCommande): self
    {
        $this->idCommande = $idCommande;

        return $this;
    }

    public function getIdDefi(): ?Defi
    {
        return $this->idDefi;
    }

    public function setIdDefi(?Defi $idDefi): self
    {
        $this->idDefi = $idDefi;

        return $this;
    }


}
