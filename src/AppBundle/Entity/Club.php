<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use GetSetGo\SetterGetter;

/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity
 */
class Club
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

