<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetailsDefi
 *
 * @ORM\Table(name="details_defi", indexes={@ORM\Index(name="EquipeA", columns={"EquipeA"}), @ORM\Index(name="id_defi", columns={"id_defi"}), @ORM\Index(name="EquipeB", columns={"EquipeB"})})
 * @ORM\Entity
 */
class DetailsDefi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Statistique", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStatistique;

    /**
     * @var string
     *
     * @ORM\Column(name="imgScore", type="string", length=255, nullable=false)
     */
    private $imgscore;

    /**
     * @var string
     *
     * @ORM\Column(name="Score_finale", type="string", length=255, nullable=false)
     */
    private $scoreFinale;

    /**
     * @var \Defi
     *
     * @ORM\ManyToOne(targetEntity="Defi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_defi", referencedColumnName="id_Defi")
     * })
     */
    private $idDefi;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EquipeB", referencedColumnName="id_Equipe")
     * })
     */
    private $equipeb;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EquipeA", referencedColumnName="id_Equipe")
     * })
     */
    private $equipea;

    public function getIdStatistique(): ?int
    {
        return $this->idStatistique;
    }

    public function getImgscore(): ?string
    {
        return $this->imgscore;
    }

    public function setImgscore(string $imgscore): self
    {
        $this->imgscore = $imgscore;

        return $this;
    }

    public function getScoreFinale(): ?string
    {
        return $this->scoreFinale;
    }

    public function setScoreFinale(string $scoreFinale): self
    {
        $this->scoreFinale = $scoreFinale;

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

    public function getEquipeb(): ?Equipe
    {
        return $this->equipeb;
    }

    public function setEquipeb(?Equipe $equipeb): self
    {
        $this->equipeb = $equipeb;

        return $this;
    }

    public function getEquipea(): ?Equipe
    {
        return $this->equipea;
    }

    public function setEquipea(?Equipe $equipea): self
    {
        $this->equipea = $equipea;

        return $this;
    }


}
