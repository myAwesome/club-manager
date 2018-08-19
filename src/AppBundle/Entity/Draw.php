<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use GetSetGo\SetterGetter;

/**
 * Draw
 *
 * @ORM\Table(name="draw")
 * @ORM\Entity
 */
class Draw
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



    public function  __toString()
    {
        return (string) $this->id;
    }


}

