<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StreamInfo
 *
 * @ORM\Table(name="stream_info", indexes={@ORM\Index(name="id_souscat", columns={"id_souscat"})})
 * @ORM\Entity
 */
class StreamInfo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Stream", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStream;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_Stream", type="string", length=75, nullable=false)
     */
    private $nomStream;

    /**
     * @var string
     *
     * @ORM\Column(name="image_Stream", type="string", length=255, nullable=false)
     */
    private $imageStream;

    /**
     * @var string
     *
     * @ORM\Column(name="description_Stream", type="text", length=0, nullable=false)
     */
    private $descriptionStream;

    /**
     * @var int
     *
     * @ORM\Column(name="id_souscat", type="integer", nullable=false)
     */
    private $idSouscat;

    public function getIdStream(): ?int
    {
        return $this->idStream;
    }

    public function getNomStream(): ?string
    {
        return $this->nomStream;
    }

    public function setNomStream(string $nomStream): self
    {
        $this->nomStream = $nomStream;

        return $this;
    }

    public function getImageStream(): ?string
    {
        return $this->imageStream;
    }

    public function setImageStream(string $imageStream): self
    {
        $this->imageStream = $imageStream;

        return $this;
    }

    public function getDescriptionStream(): ?string
    {
        return $this->descriptionStream;
    }

    public function setDescriptionStream(string $descriptionStream): self
    {
        $this->descriptionStream = $descriptionStream;

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
