<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vangrg\ProfanityBundle\Validator\Constraints as ProfanityAssert;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="id_livestream", columns={"id_livestream"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_commentaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_commentaire", type="string", length=250, nullable=false)
     * @ProfanityAssert\ProfanityCheck
     */
    private $contenuCommentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commentaire", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateCommentaire = 'CURRENT_TIMESTAMP';

    function __construct(){
        $this -> dateCommentaire = new \DateTime();

    }
    /**
     * @var \LiveStream
     *
     * @ORM\ManyToOne(targetEntity="LiveStream")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_livestream", referencedColumnName="id_LiveStream")
     * })
     */
    private $idLivestream;

    public function getIdCommentaire(): ?int
    {
        return $this->idCommentaire;
    }

    public function getContenuCommentaire(): ?string
    {
        return $this->contenuCommentaire;
    }

    public function setContenuCommentaire(string $contenuCommentaire): self
    {
        $this->contenuCommentaire = $contenuCommentaire;

        return $this;
    }

    public function getDateCommentaire(): ?\DateTimeInterface
    {
        return $this->dateCommentaire;
    }

    public function setDateCommentaire(\DateTimeInterface $dateCommentaire): self
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    public function getIdLivestream(): ?LiveStream
    {
        return $this->idLivestream;
    }

    public function setIdLivestream(?LiveStream $idLivestream): self
    {
        $this->idLivestream = $idLivestream;

        return $this;
    }


}
