<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity
 * @ApiResource
 */
class Club
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
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City")
     */
    private $city;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Championat", mappedBy="club")
     */
    private $championats;


    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Ranking", mappedBy="club")
     */
    private $rankings;



    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return Club
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return Club
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getChampionats()
    {
        return $this->championats;
    }

    /**
     * @param ArrayCollection $championats
     * @return Club
     */
    public function setChampionats($championats)
    {
        $this->championats = $championats;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getRankings()
    {
        return $this->rankings;
    }

    /**
     * @param ArrayCollection $rankings
     * @return Club
     */
    public function setRankings($rankings)
    {
        $this->rankings = $rankings;
        return $this;
    }




}

