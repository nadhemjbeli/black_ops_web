<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ReplayStream
 *
 * @ORM\Table(name="replay_stream", indexes={@ORM\Index(name="id_souscat", columns={"id_souscat"})})
 * @ORM\Entity
 */
class ReplayStream
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Replay", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReplay;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_Replay", type="string", length=150, nullable=false)
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\Length(min=4,max=150, minMessage = "le nom doit être au moins {{ min }} characters long",
     *      maxMessage = "la nom ne pêut pas depasser {{ max }} characters")
     */
    private $nomReplay;

    /**
     * @var string
     *
     * @ORM\Column(name="URL_video", type="string", length=255, nullable=false)
     * @Assert\Type("string")
     * @Assert\Length(max=255,  maxMessage = "la nom ne pêut pas depasser {{ max }} characters")
     */
    private $urlVideo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $date = 'CURRENT_TIMESTAMP';

    function __construct() {
        $this->date = new \DateTime();
    }
    /**
     * @var string
     *
     * @ORM\Column(name="Description_Replay", type="string", length=300, nullable=false)
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(min=10,max=300, minMessage = "le champs doit être au moins {{ min }} characters long",
     *      maxMessage = "le champs ne pêut pas depasser {{ max }} characters")
     */
    private $descriptionReplay;

    /**
     * @var int
     *
     * @ORM\Column(name="vues_Replay", type="integer", nullable=false)
     */
    private $vuesReplay = '0';

    /**
     * @var \SousCategorie
     *
     * @ORM\ManyToOne(targetEntity="SousCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_souscat", referencedColumnName="id_SousCat")
     * })
     * @Assert\NotNull
     */
    private $idSouscat;

    public function getIdReplay(): ?int
    {
        return $this->idReplay;
    }

    public function getNomReplay(): ?string
    {
        return $this->nomReplay;
    }

    public function setNomReplay(string $nomReplay): self
    {
        $this->nomReplay = $nomReplay;

        return $this;
    }

    public function getUrlVideo(): ?string
    {
        return $this->urlVideo;
    }

    public function setUrlVideo(string $urlVideo): self
    {
        $this->urlVideo = $urlVideo;

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

    public function getDescriptionReplay(): ?string
    {
        return $this->descriptionReplay;
    }

    public function setDescriptionReplay(string $descriptionReplay): self
    {
        $this->descriptionReplay = $descriptionReplay;

        return $this;
    }

    public function getVuesReplay(): ?int
    {
        return $this->vuesReplay;
    }

    public function setVuesReplay(int $vuesReplay): self
    {
        $this->vuesReplay = $vuesReplay;

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


}
