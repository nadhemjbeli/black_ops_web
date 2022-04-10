<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skin
 *
 * @ORM\Table(name="skin", indexes={@ORM\Index(name="Id_champ", columns={"Id_champ"})})
 * @ORM\Entity
 */
class Skin
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_skin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSkin;

    /**
     * @var string
     *
     * @ORM\Column(name="image_skin", type="string", length=255, nullable=false)
     */
    private $imageSkin;

    /**
     * @var int
     *
     * @ORM\Column(name="Id_champ", type="integer", nullable=false)
     */
    private $idChamp;

    public function getIdSkin(): ?int
    {
        return $this->idSkin;
    }

    public function getImageSkin(): ?string
    {
        return $this->imageSkin;
    }

    public function setImageSkin(string $imageSkin): self
    {
        $this->imageSkin = $imageSkin;

        return $this;
    }

    public function getIdChamp(): ?int
    {
        return $this->idChamp;
    }

    public function setIdChamp(int $idChamp): self
    {
        $this->idChamp = $idChamp;

        return $this;
    }


}
