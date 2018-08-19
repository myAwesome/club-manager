<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use GetSetGo\SetterGetter;

/**
 * Group
 *
 * @ORM\Table(name="_group")
 * @ORM\Entity
 */
class Group
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


}

