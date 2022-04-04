<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VideoUploade
 * @ORM\Entity(repositoryClass="App\Repository\VideoUploadeRepository")
 * @ORM\Table(name="video_uploade", indexes={@ORM\Index(name="id_souscat", columns={"id_souscat"}), @ORM\Index(name="id_cl", columns={"id_cl"})})
 * @ORM\Entity
 */
class VideoUploade
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Vdeo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVdeo;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_Video", type="string", length=75, nullable=false)
     */
    private $nomVideo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_Video", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateVideo = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="description_Video", type="text", length=0, nullable=false)
     */
    private $descriptionVideo;

    /**
     * @var string
     *
     * @ORM\Column(name="url_Video", type="string", length=255, nullable=false)
     */
    private $urlVideo;

    /**
     * @var int
     *
     * @ORM\Column(name="id_souscat", type="integer", nullable=false)
     */
    private $idSouscat;

    /**
     * @var int
     *
     * @ORM\Column(name="id_cl", type="integer", nullable=false)
     */
    private $idCl;

    public function getIdVdeo(): ?int
    {
        return $this->idVdeo;
    }

    public function getNomVideo(): ?string
    {
        return $this->nomVideo;
    }

    public function setNomVideo(string $nomVideo): self
    {
        $this->nomVideo = $nomVideo;

        return $this;
    }

    public function getDateVideo(): ?\DateTimeInterface
    {
        return $this->dateVideo;
    }

    public function setDateVideo(\DateTimeInterface $dateVideo): self
    {
        $this->dateVideo = $dateVideo;

        return $this;
    }

    public function getDescriptionVideo(): ?string
    {
        return $this->descriptionVideo;
    }

    public function setDescriptionVideo(string $descriptionVideo): self
    {
        $this->descriptionVideo = $descriptionVideo;

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

    public function getIdSouscat(): ?int
    {
        return $this->idSouscat;
    }

    public function setIdSouscat(int $idSouscat): self
    {
        $this->idSouscat = $idSouscat;

        return $this;
    }

    public function getIdCl(): ?int
    {
        return $this->idCl;
    }

    public function setIdCl(int $idCl): self
    {
        $this->idCl = $idCl;

        return $this;
    }


}
