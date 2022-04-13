<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 * @ORM\Table(name="contact")
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_contact", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContact;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="np_contact", type="string", length=75, nullable=false)
     */
    private $npContact;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="mail_contact", type="string", length=100, nullable=false)
     */
    private $mailContact;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="message", type="text", length=0, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $date ;

    public function getIdContact(): ?int
    {
        return $this->idContact;
    }

    public function getNpContact(): ?string
    {
        return $this->npContact;
    }

    public function setNpContact(string $npContact): self
    {
        $this->npContact = $npContact;

        return $this;
    }

    public function getMailContact(): ?string
    {
        return $this->mailContact;
    }

    public function setMailContact(string $mailContact): self
    {
        $this->mailContact = $mailContact;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }


    public function setDate(): self
    {
        $current = new \DateTime();
        $current->modify('+ 1 Hour');
        $this->date = $current;

        return $this;
    }


}
