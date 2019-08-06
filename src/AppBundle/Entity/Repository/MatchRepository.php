<?php


namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Player;
use Doctrine\ORM\EntityRepository;

class MatchRepository extends EntityRepository
{
    public function headTohead(Player $player1, Player $player2)
    {
        return $this
            ->createQueryBuilder('m')
            ->where('m.player1 = :player1 and m.player2 = :player2')
            ->orWhere('m.player1 = :player2 and m.player2 = :player1')
            ->setParameter('player1', $player1)
            ->setParameter('player2', $player2)
            ->orderBy('m.date', 'desc')
            ->getQuery()
            ->getResult();
    }

    public function byPlayer(Player $player)
    {
        return $this->createQueryBuilder('m')
            ->where('m.player1 = :player')
            ->orWhere('m.player2 = :player')
            ->setParameter('player', $player)
            ->orderBy('m.date', 'desc')
            ->getQuery()
            ->getResult();
    }
}