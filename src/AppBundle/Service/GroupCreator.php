<?php

namespace AppBundle\Service;


use AppBundle\Entity\Group;
use AppBundle\Entity\Match;
use Doctrine\ORM\EntityManager;

class GroupCreator
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * GroupCreator constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function createMatches(Group $group)
    {
        $players = $group->getPlayers();
        foreach ($players as $key => $player) {
            for ($opponent_id = $key+1; $opponent_id < $group->getCapacity(); $opponent_id++) {
                $match = new Match();
                $match->setDate($group->getChampionat()->getStartAt());
                $match->setGroup($group);
                $match->setPlayer1($player);
                $match->setPlayer2($players[$opponent_id]);
                $this->em->persist($match);
            }
        }
        $this->em->flush();
    }

}