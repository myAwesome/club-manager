<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Group
 *
 * @ORM\Table(name="_group")
 * @ORM\Entity
 * @ApiResource
 */
class Group
{

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
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * todo:  2, 3, 4, 5, 6 ?
     * @var string
     *
     * @ORM\Column(name="capacity", type="string", length=45, nullable=true)
     */
    private $capacity;

    /**
     * @var Championat
     *
     * @ORM\ManyToOne(targetEntity="Championat")
     */
    private $championat;

    /**
     * @ORM\ManyToMany(targetEntity="Player")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity="Match", mappedBy="group")
     */
    private $matches;

    /**
     * Group constructor.
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->matches = new ArrayCollection();
    }


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
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param string $capacity
     * @return Group
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * @return Championat
     */
    public function getChampionat()
    {
        return $this->championat;
    }

    /**
     * @param Championat $championat
     * @return Group
     */
    public function setChampionat($championat)
    {
        $this->championat = $championat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param mixed $players
     * @return Group
     */
    public function setPlayers($players)
    {
        $this->players = $players;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * @param mixed $matches
     * @return Group
     */
    public function setMatches($matches)
    {
        $this->matches = $matches;
        return $this;
    }



}

