<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Message
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 * @ORM\Table(name="message", indexes={@ORM\Index(name="id_cl", columns={"id_cl"}), @ORM\Index(name="id_souscat", columns={"id_souscat"})})
 * @ORM\Entity
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMessage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_message", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateMessage;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="Contenu_message", type="text", length=0, nullable=false)
     */
    private $contenuMessage;

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

    public function getIdMessage(): ?int
    {
        return $this->idMessage;
    }

    public function getDateMessage(): ?\DateTimeInterface
    {
        return $this->dateMessage;
    }

    public function setDateMessage(): self
    {
        $current = new \DateTime();
        $current->modify('- 1 Hour');
        $this->dateMessage = $current;

        return $this;
    }

    public function getContenuMessage(): ?string
    {
        return $this->contenuMessage;
    }

    public function setContenuMessage(string $contenuMessage): self
    {
        $this->contenuMessage = $contenuMessage;

        return $this;
    }

    public function getIdCl(): ?User
    {
        return $this->idCl;
    }

    public function setIdCl(?User $idCl): self
    {
        $this->idCl = $idCl;

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
