<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GetSetGo\SetterGetter;

/**
 * Court
 *
 * @ORM\Table(name="court")
 * @ORM\Entity
 */
class Court
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
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=45, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=45, nullable=true)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="surface", type="string", length=255, nullable=true)
     */
    private $surface;

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
        return $this->name;
    }
}

