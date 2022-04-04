<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $nomReplay;

    /**
     * @var string
     *
     * @ORM\Column(name="URL_video", type="string", length=255, nullable=false)
     */
    private $urlVideo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="Description_Replay", type="string", length=300, nullable=false)
     */
    private $descriptionReplay;

    /**
     * @var int
     *
     * @ORM\Column(name="vues_Replay", type="integer", nullable=false)
     */
    private $vuesReplay = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="id_souscat", type="integer", nullable=false)
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

    public function getIdSouscat(): ?int
    {
        return $this->idSouscat;
    }

    public function setIdSouscat(int $idSouscat): self
    {
        $this->idSouscat = $idSouscat;

        return $this;
    }


}
