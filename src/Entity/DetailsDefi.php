<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DetailsDefi
 *
 * @ORM\Table(name="details_defi", indexes={@ORM\Index(name="EquipeB", columns={"EquipeB"}), @ORM\Index(name="id_defi", columns={"id_defi"}), @ORM\Index(name="EquipeA", columns={"EquipeA"})})
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
     * @ORM\Column(name="imgScore", type="string", length=255, nullable=true)
     */
    private $imgscore;

    /**
     * @var string
     *
     * @ORM\Column(name="Score_finale", type="string", length=255, nullable=true)
     */
    private $scoreFinale;

    /**
     * @var \Equipe
     *@Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EquipeB", referencedColumnName="id_Equipe")
     * })
     */
    private $equipeb;

    /**
     * @var \Equipe
     *@Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EquipeA", referencedColumnName="id_Equipe")
     * })
     */
    private $equipea;

    /**
     * @var \Defi
     *@Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="Defi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_defi", referencedColumnName="id_Defi" )
     * })
     */
    private $idDefi;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date;



    public function getIdStatistique(): ?int
    {
        return $this->idStatistique;
    }

    public function getImgscore()
    {
        return $this->imgscore;
    }

    public function setImgscore($imgscore)
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

    public function getIdDefi(): ?Defi
    {
        return $this->idDefi;
    }

    public function setIdDefi(?Defi $idDefi): self
    {
        $this->idDefi = $idDefi;

        return $this;
    }
    public function getIdEquipeb(): int
    {
        return $this->equipeb->getIdEquipe();
    }
    public function getIdEquipea(): int
    {
        return $this->equipea->getIdEquipe();
    }
    public function getDefi(): int
    {
        return $this->idDefi->getIdDefi();
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate( ?\DateTimeInterface $date)
    {
        $this->date = $date;

        return $this;
    }

}
