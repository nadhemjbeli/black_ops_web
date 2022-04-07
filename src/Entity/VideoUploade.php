<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @ORM\Column(name="nom_Video", type="string", length=75, nullable=false)
     */
    private $nomVideo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_Video", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateVideo;

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
     * @var \SousCategorie
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="SousCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_souscat", referencedColumnName="id_SousCat")
     * })
     */
    private $idSouscat;

    /**
     * @var \User
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cl", referencedColumnName="id_user")
     * })
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

//    public function setDateVideo(\DateTimeInterface $dateVideo): self
//    {
//        $this->dateVideo = $dateVideo;
//
//        return $this;
//    }

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

    public function getIdSouscat(): ?SousCategorie
    {
        return $this->idSouscat;
    }

    public function setIdSouscat(int $idSouscat): self
    {
        $this->idSouscat = $idSouscat;

        return $this;
    }

    public function getIdCl(): ?User
    {
        return $this->idCl;
    }

    public function setIdCl(int $idCl): self
    {
        $this->idCl = $idCl;

        return $this;
    }


}
