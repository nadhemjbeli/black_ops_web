<?php

namespace App\Entity;

use App\Repository\LikeMessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LikeMessageRepository::class)
 */
class LikeMessage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $react = 1;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cl", referencedColumnName="id_user")
     * })
     */
    private $idCl;

    /**
     * @var \Message
     *
     * @ORM\ManyToOne(targetEntity="Message")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_message", referencedColumnName="id_message")
     * })
     */
    private $idMessage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReact(): ?int
    {
        return $this->react;
    }

    public function setReact(int $react): self
    {
        $this->react = $react;

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

    public function getIdMessage(): ?Message
    {
        return $this->idMessage;
    }

    public function setIdMessage(?Message $idMessage): self
    {
        $this->idMessage = $idMessage;

        return $this;
    }
}
