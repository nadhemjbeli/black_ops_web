<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @ORM\Table(name="admin", uniqueConstraints={@ORM\UniqueConstraint(name="mail_admin", columns={"mail_admin"})})
 * @ORM\Entity
 */
class Admin
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_admin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_admin", type="string", length=254, nullable=false)
     */
    private $mailAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="password_admin", type="string", length=50, nullable=false)
     */
    private $passwordAdmin;

    /**
     * @var int
     *
     * @ORM\Column(name="grade", type="integer", nullable=false)
     */
    private $grade;

    /**
     * @var int
     *
     * @ORM\Column(name="NewPass", type="integer", nullable=false)
     */
    private $newpass = '0';

    public function getIdAdmin(): ?int
    {
        return $this->idAdmin;
    }

    public function getMailAdmin(): ?string
    {
        return $this->mailAdmin;
    }

    public function setMailAdmin(string $mailAdmin): self
    {
        $this->mailAdmin = $mailAdmin;

        return $this;
    }

    public function getPasswordAdmin(): ?string
    {
        return $this->passwordAdmin;
    }

    public function setPasswordAdmin(string $passwordAdmin): self
    {
        $this->passwordAdmin = $passwordAdmin;

        return $this;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getNewpass(): ?int
    {
        return $this->newpass;
    }

    public function setNewpass(int $newpass): self
    {
        $this->newpass = $newpass;

        return $this;
    }


}
