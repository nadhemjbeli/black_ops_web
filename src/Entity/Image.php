<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Image
 *
 * @ORM\Table(name="image", indexes={@ORM\Index(name="Id_jeu", columns={"Id_jeu"})})
 * @ORM\Entity
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Image", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idImage;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="Url_Image", type="string", length=255, nullable=false)
     */
    private $urlImage;

    /**
     * @var \Jeu
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Jeu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_jeu", referencedColumnName="Id_Jeu")
     * })
     */
    private $idJeu;

    public function getIdImage(): ?int
    {
        return $this->idImage;
    }

    public function getUrlImage(): ?string
    {
        return $this->urlImage;
    }

    public function setUrlImage(string $urlImage): self
    {
        $this->urlImage = $urlImage;

        return $this;
    }

    public function getIdJeu(): ?Jeu
    {
        return $this->idJeu;
    }

    public function setIdJeu(?Jeu $idJeu): self
    {
        $this->idJeu = $idJeu;

        return $this;
    }

    public function __toString():string
    {
        return $this->getUrlImage();
    }


}
