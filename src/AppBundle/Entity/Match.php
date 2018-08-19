<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GetSetGo\SetterGetter;

/**
 * Match
 *
 * @ORM\Table(name="_match")
 * @ORM\Entity
 */
class Match
{
    use SetterGetter;

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

}

