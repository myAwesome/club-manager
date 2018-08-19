<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GetSetGo\SetterGetter;

/**
 * @ORM\Table(name="championat_player")
 * @ORM\Entity
 */
class ChampionatHasPlayer
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


}

