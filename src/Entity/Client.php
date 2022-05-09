<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client", uniqueConstraints={@ORM\UniqueConstraint(name="Pseaudo", columns={"Pseaudo_Cl"})})
 * @ORM\Entity
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Cl", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCl;

    /**
     * @var string
     *
     * @ORM\Column(name="Pseaudo_Cl", type="string", length=20, nullable=false)
     */
    private $pseaudoCl;

    /**
     * @var string
     *
     * @ORM\Column(name="Photo_Cl", type="text", length=0, nullable=false)
     */
    private $photoCl;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_Cl", type="string", length=100, nullable=false)
     */
    private $mailCl;

    /**
     * @var string
     *
     * @ORM\Column(name="pass_Cl", type="string", length=50, nullable=false)
     */
    private $passCl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateNaissance_Cl", type="date", nullable=false)
     */
    private $datenaissanceCl;

    /**
     * @var string
     *
     * @ORM\Column(name="Statut_Cl", type="string", length=10, nullable=false, options={"default"="offline"})
     */
    private $statutCl = 'offline';

    /**
     * @var int
     *
     * @ORM\Column(name="NewPass_Cl", type="integer", nullable=false)
     */
    private $newpassCl = '0';

    public function getIdCl(): ?int
    {
        return $this->idCl;
    }

    public function getPseaudoCl(): ?string
    {
        return $this->pseaudoCl;
    }

    public function setPseaudoCl(string $pseaudoCl): self
    {
        $this->pseaudoCl = $pseaudoCl;

        return $this;
    }

    public function getPhotoCl(): ?string
    {
        return $this->photoCl;
    }

    public function setPhotoCl(string $photoCl): self
    {
        $this->photoCl = $photoCl;

        return $this;
    }

    public function getMailCl(): ?string
    {
        return $this->mailCl;
    }

    public function setMailCl(string $mailCl): self
    {
        $this->mailCl = $mailCl;

        return $this;
    }

    public function getPassCl(): ?string
    {
        return $this->passCl;
    }

    public function setPassCl(string $passCl): self
    {
        $this->passCl = $passCl;

        return $this;
    }

    public function getDatenaissanceCl(): ?\DateTimeInterface
    {
        return $this->datenaissanceCl;
    }

    public function setDatenaissanceCl(\DateTimeInterface $datenaissanceCl): self
    {
        $this->datenaissanceCl = $datenaissanceCl;

        return $this;
    }

    public function getStatutCl(): ?string
    {
        return $this->statutCl;
    }

    public function setStatutCl(string $statutCl): self
    {
        $this->statutCl = $statutCl;

        return $this;
    }

    public function getNewpassCl(): ?int
    {
        return $this->newpassCl;
    }

    public function setNewpassCl(int $newpassCl): self
    {
        $this->newpassCl = $newpassCl;

        return $this;
    }


}
