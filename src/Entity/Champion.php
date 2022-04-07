<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Champion
 *
 * @ORM\Table(name="champion", indexes={@ORM\Index(name="Id_Jeu", columns={"Id_jeu"})})
 * @ORM\Entity
 */
class Champion
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Champ", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idChamp;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="Nom_Champ", type="string", length=75, nullable=false)
     */
    private $nomChamp;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="description_Champ", type="text", length=0, nullable=false)
     */
    private $descriptionChamp;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="Role_Champ", type="string", length=75, nullable=false)
     */
    private $roleChamp;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="Difficulte_Champ", type="string", length=25, nullable=false)
     */
    private $difficulteChamp;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="Image_Champ", type="text", length=0, nullable=false)
     */
    private $imageChamp;

    /**
     * @var \Jeu
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Jeu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_jeu", referencedColumnName="Id_Jeu")
     * })
     */
    private $idJeu;

    public function getIdChamp(): ?int
    {
        return $this->idChamp;
    }

    public function getNomChamp(): ?string
    {
        return $this->nomChamp;
    }

    public function setNomChamp(string $nomChamp): self
    {
        $this->nomChamp = $nomChamp;

        return $this;
    }

    public function getDescriptionChamp(): ?string
    {
        return $this->descriptionChamp;
    }

    public function setDescriptionChamp(string $descriptionChamp): self
    {
        $this->descriptionChamp = $descriptionChamp;

        return $this;
    }

    public function getRoleChamp(): ?string
    {
        return $this->roleChamp;
    }

    public function setRoleChamp(string $roleChamp): self
    {
        $this->roleChamp = $roleChamp;

        return $this;
    }

    public function getDifficulteChamp(): ?string
    {
        return $this->difficulteChamp;
    }

    public function setDifficulteChamp(string $difficulteChamp): self
    {
        $this->difficulteChamp = $difficulteChamp;

        return $this;
    }

    public function getImageChamp()
    {
        return $this->imageChamp;
    }

    public function setImageChamp($imageChamp)
    {
        $this->imageChamp = $imageChamp;

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
        return $this->getNomChamp();
    }
    public function getImagePath(): string
    {
        return 'uploads/champions/'.$this->getImageChamp();
    }
}
