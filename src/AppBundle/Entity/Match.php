<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Match
 *
 * @ORM\Table(name="_match")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\MatchRepository")
 */
class Match
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="player_1_points", type="integer", nullable=true)
     */
    private $player1Points;

    /**
     * @var integer
     *
     * @ORM\Column(name="player_2_points", type="integer", nullable=true)
     */
    private $player2Points;

    /**
     * @var Draw
     *
     * @ORM\ManyToOne(targetEntity="Draw")
     */
    private $draw;

    /**
     * Final 1, Semi-2, Q-3, 1/8, 1/32
     * Last2, Last4, Last8, last16
     *
     * @var int
     * @ORM\Column(name="draw_round", type="integer", nullable=true)
     */
    private $drawRound;

    /**
     * First Semi, Second Semi -  1, 2. Quoterfinals 1,2,3,4
     * @var int
     * @ORM\Column(name="draw_round_number", type="integer", nullable=true)
     */
    private $drawRoundNumber;

    /**
     * @var Group
     *
     * @ORM\ManyToOne(targetEntity="Group")
     */
    private $group;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player1;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player2;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Match
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlayer1Points()
    {
        return $this->player1Points;
    }

    /**
     * @param int $player1Points
     * @return Match
     */
    public function setPlayer1Points($player1Points)
    {
        $this->player1Points = $player1Points;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlayer2Points()
    {
        return $this->player2Points;
    }

    /**
     * @param int $player2Points
     * @return Match
     */
    public function setPlayer2Points($player2Points)
    {
        $this->player2Points = $player2Points;
        return $this;
    }

    /**
     * @return Draw
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * @param Draw $draw
     * @return Match
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;
        return $this;
    }

    /**
     * @return int
     */
    public function getDrawRound()
    {
        return $this->drawRound;
    }

    /**
     * @param int $drawRound
     * @return Match
     */
    public function setDrawRound($drawRound)
    {
        $this->drawRound = $drawRound;
        return $this;
    }

    /**
     * @return int
     */
    public function getDrawRoundNumber()
    {
        return $this->drawRoundNumber;
    }

    /**
     * @param int $drawRoundNumber
     * @return Match
     */
    public function setDrawRoundNumber($drawRoundNumber)
    {
        $this->drawRoundNumber = $drawRoundNumber;
        return $this;
    }

    /**
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param Group $group
     * @return Match
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return Player
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * @param Player $player1
     * @return Match
     */
    public function setPlayer1($player1)
    {
        $this->player1 = $player1;
        return $this;
    }

    /**
     * @return Player
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * @param Player $player2
     * @return Match
     */
    public function setPlayer2($player2)
    {
        $this->player2 = $player2;
        return $this;
    }



}

