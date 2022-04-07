<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $nomLivestream;

    /**
     * @var string
     *
     * @ORM\Column(name="Path_LiveStream", type="string", length=500, nullable=false)
     */
    private $pathLivestream;

    /**
     * @var string
     *
     * @ORM\Column(name="Visibilite_LiveStream", type="string", length=150, nullable=false)
     */
    private $visibiliteLivestream;

    /**
     * @var int
     *
     * @ORM\Column(name="id_defi", type="integer", nullable=false)
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

    public function getIdDefi(): ?int
    {
        return $this->idDefi;
    }

    public function setIdDefi(int $idDefi): self
    {
        $this->idDefi = $idDefi;

        return $this;
    }


}
