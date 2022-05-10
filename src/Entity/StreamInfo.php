<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints as CaptchaAssert;

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
     * @Assert\Length(min=5,max=75, minMessage = "le nom doit être au moins {{ min }} characters long",
     *      maxMessage = "la nom ne pêut pas depasser {{ max }} characters")
     * @Assert\NotBlank
     */
    private $nomStream;

    /**
     * @var string
     * @ORM\Column(name="image_Stream", type="string", length=255, nullable=false)
     */
    private $imageStream;

    /**
     * @var string
     *
     * @ORM\Column(name="description_Stream", type="text", length=7000, nullable=false)
     * @Assert\Length(min=15,max=7000, minMessage = "le nom doit être au moins {{ limit }} characters long",
     *      maxMessage = "la nom ne pêut pas depasser {{ max }} characters")
     */
    private $descriptionStream;

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

    /**
     * @CaptchaAssert\ValidCaptcha(
     *      message = "CAPTCHA validation failed, try again."
     * )
     */
    protected $captchaCode;

    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }

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
