<?php

namespace AppBundle\Service;


use AppBundle\Entity\Draw;
use AppBundle\Entity\Match;
use Doctrine\ORM\EntityManager;

class DrawCreator
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * DrawCreator constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Depending on draw size, create number of matches
     * @param Draw $draw
     * @throws \Exception
     */
    public function createMatches(Draw $draw)
    {
        $drawSize = $draw->getCapacity();
        $playersPerRound = [2,4,8,16,32,64,128,256];
        foreach ($playersPerRound as $players) {

            if($drawSize >= $players){
                $round = $players;
                $iterations = $players/2;
                for ($i = 1; $i < $iterations+1; $i++){
                    $match = new Match();
                    $match->setDraw($draw);
//                    todo: 842  -> 321
                    $match->setDrawRound($round);
                    $match->setDrawRoundNumber($i);
                    $this->em->persist($match);
                }
            }
        }
        $this->em->flush();
    }


}