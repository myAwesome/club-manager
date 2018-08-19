<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GetSetGo\SetterGetter;

/**
 * Player
 *
 * @ORM\Table(name="player", indexes={@ORM\Index(name="fk_player_city1_idx", columns={"city_id"})})
 * @ORM\Entity
 */
class Player
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
     * @ORM\Column(name="first_name", type="string", length=45, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="forehand", type="string", length=45, nullable=true)
     */
    private $forehand;

    /**
     * @var string
     *
     * @ORM\Column(name="backhand", type="string", length=45, nullable=true)
     */
    private $backhand;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=45, nullable=true)
     */
    private $level;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City")
     */
    private $city;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->lastName . ' ' . $this->firstName;
    }
}

