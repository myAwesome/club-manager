<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use GetSetGo\SetterGetter;

/**
 * @ORM\Table(name="championat")
 * @ORM\Entity
 */
class Championat
{
    use SetterGetter;


    const SINGLE = 'single';
    const DOUBLE = 'double';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * Single or double
     *
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_at", type="datetime", nullable=false)
     */
    private $startAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_at", type="datetime", nullable=false)
     */
    private $endAt;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Club
     * @ORM\ManyToOne(targetEntity="Club", inversedBy="championats")
     */
    private $club;

    /**
     * @var Court
     *
     * @ORM\ManyToOne(targetEntity="Club")
     */
    private $court;

    /**
     * @var Ranking
     *
     * @ORM\ManyToOne(targetEntity="Ranking")
     */
    private $ranking;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="ChampionatHasPlayer", mappedBy="championat")
     */
    private $players;

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

