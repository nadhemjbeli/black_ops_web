<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mode
 *
 * @ORM\Table(name="mode")
 * @ORM\Entity
 */
class Mode
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_mode", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMode;

    /**
     * @var int
     *
     * @ORM\Column(name="dark_mode", type="integer", nullable=false)
     */
    private $darkMode = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="light_mode", type="integer", nullable=false, options={"default"="1"})
     */
    private $lightMode = 1;

    public function getIdMode(): ?int
    {
        return $this->idMode;
    }

    public function getDarkMode(): ?int
    {
        return $this->darkMode;
    }

    public function setDarkMode(int $darkMode): self
    {
        $this->darkMode = $darkMode;

        return $this;
    }

    public function getLightMode(): ?int
    {
        return $this->lightMode;
    }

    public function setLightMode(int $lightMode): self
    {
        $this->lightMode = $lightMode;

        return $this;
    }


}
