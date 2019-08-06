<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="championat_player")
 * @ORM\Entity
 */
class ChampionatHasPlayer
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
     * @var Championat
     * @ORM\ManyToOne(targetEntity="Championat")
     */
    private $championat;

    /**
     * @var Player
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Player")
     *
     */
    private $player;

    /**
     * @var int
     * @ORM\Column()
     */
    private $place;

    /**
     * @var int
     * @ORM\Column()
     */
    private $points;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return ChampionatHasPlayer
     */
    public function setChampionat($championat)
    {
        $this->championat = $championat;
        return $this;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param Player $player
     * @return ChampionatHasPlayer
     */
    public function setPlayer($player)
    {
        $this->player = $player;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param int $place
     * @return ChampionatHasPlayer
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     * @return ChampionatHasPlayer
     */
    public function setPoints($points)
    {
        $this->points = $points;
        return $this;
    }



}

