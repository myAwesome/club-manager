<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="championat")
 * @ORM\Entity
 * @ApiResource
 */
class Championat
{

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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Championat
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Championat
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * @param \DateTime $startAt
     * @return Championat
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * @param \DateTime $endAt
     * @return Championat
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Championat
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Club
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * @param Club $club
     * @return Championat
     */
    public function setClub($club)
    {
        $this->club = $club;
        return $this;
    }

    /**
     * @return Court
     */
    public function getCourt()
    {
        return $this->court;
    }

    /**
     * @param Court $court
     * @return Championat
     */
    public function setCourt($court)
    {
        $this->court = $court;
        return $this;
    }

    /**
     * @return Ranking
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * @param Ranking $ranking
     * @return Championat
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param ArrayCollection $players
     * @return Championat
     */
    public function setPlayers($players)
    {
        $this->players = $players;
        return $this;
    }


}

