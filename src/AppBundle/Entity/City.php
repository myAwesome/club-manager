<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GetSetGo\SetterGetter;

/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity
 */
class City
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    public $name;


    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->name;
    }

}

