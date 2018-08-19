<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GetSetGo\SetterGetter;

/**
 * Ranking
 *
 * @ORM\Table(name="ranking")
 * @ORM\Entity
 */
class Ranking
{
    use SetterGetter;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var Club
     *
     * @ORM\ManyToOne(targetEntity="Club", inversedBy="rankings")
     */
    private $club;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->name;
    }
}

