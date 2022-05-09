<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * LiveStream
 *
 * @ORM\Table(name="live_stream", indexes={@ORM\Index(name="id_defi", columns={"id_defi"})})
 * @ORM\Entity
 */
class LiveStream
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_LiveStream", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLivestream;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_LiveStream", type="string", length=100, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(min=5,max=100, minMessage = "le nom doit être au moins {{ min }} characters long",
     *      maxMessage = "la nom ne pêut pas depasser {{ max }} characters")
     */
    private $nomLivestream;

    /**
     * @var string
     *
     * @ORM\Column(name="Path_LiveStream", type="string", length=500, nullable=false)
     * @Assert\Length(min=7,max=500, minMessage = "le nom doit être au moins {{ min }} characters long",
     *      maxMessage = "la nom ne pêut pas depasser {{ max }} characters")
     * @Assert\NotBlank
     */
    private $pathLivestream;

    /**
     * @var string
     *
     * @ORM\Column(name="Visibilite_LiveStream", type="string", length=150, nullable=false)
     * @Assert\NotBlank
     */
    private $visibiliteLivestream;

    /**
     * @var \Defi
     *
     * @ORM\ManyToOne(targetEntity="Defi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_defi", referencedColumnName="id_Defi")
     * })
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    private $idDefi;

    public function getIdLivestream(): ?int
    {
        return $this->idLivestream;
    }

    public function getNomLivestream(): ?string
    {
        return $this->nomLivestream;
    }

    public function setNomLivestream(string $nomLivestream): self
    {
        $this->nomLivestream = $nomLivestream;

        return $this;
    }

    public function getPathLivestream(): ?string
    {
        return $this->pathLivestream;
    }

    public function setPathLivestream(string $pathLivestream): self
    {
        $this->pathLivestream = $pathLivestream;

        return $this;
    }

    public function getVisibiliteLivestream(): ?string
    {
        return $this->visibiliteLivestream;
    }

    public function setVisibiliteLivestream(string $visibiliteLivestream): self
    {
        $this->visibiliteLivestream = $visibiliteLivestream;

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
