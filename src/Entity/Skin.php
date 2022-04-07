<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\NotBlank()
     * @ORM\Column(name="image_skin", type="string", length=255, nullable=false)
     */
    private $imageSkin;

    /**
     * @var \Champion
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Champion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_Champ", referencedColumnName="Id_Champ")
     * })
     */
    private $idChamp;

    public function getIdSkin(): ?int
    {
        return $this->idSkin;
    }

    public function getImageSkin()
    {
        return $this->imageSkin;
    }

    public function setImageSkin($imageSkin)
    {
        $this->imageSkin = $imageSkin;

        return $this;
    }

    public function getIdChamp(): ?Champion
    {
        return $this->idChamp;
    }

    public function setIdChamp(Champion $idChamp): self
    {
        $this->idChamp = $idChamp;

        return $this;
    }
    public function getImagePath(): string
    {
        return 'uploads/skins/'.$this->getImageSkin();
    }

}
