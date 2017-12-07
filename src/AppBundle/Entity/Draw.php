<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Draw
 *
 * @ORM\Table(name="draw")
 * @ORM\Entity
 */
class Draw
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
     * @ORM\Column(name="capacity", type="string", length=45, nullable=false)
     */
    private $capacity;

    /**
     * @var Championat
     *
     * @ORM\ManyToOne(targetEntity="Championat")
     */
    private $championat;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Match", mappedBy="draw")
     */
    private $matches;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
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
     */
    public function setChampionat($championat)
    {
        $this->championat = $championat;
    }

    /**
     * @return ArrayCollection]
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * @param Match[] $matches
     */
    public function setMatches($matches)
    {
        $this->matches = $matches;
    }

    public function  __toString()
    {
        return (string) $this->id;
    }


}

