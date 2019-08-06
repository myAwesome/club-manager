<?php


namespace AppBundle\Command;

use AppBundle\Entity\Match;
use AppBundle\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ParsePlayerActivityCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('acme_demo:parse_player')
            ->setDescription('Just for fixtures');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $vova = $em->find('AppBundle:Player', 1);
        $link = 'http://intennis.com.ua/site/player.php?id=2161';

        $crawler = new Crawler(
            file_get_contents($link)
        );

        $statistic = $crawler->filter('div.statistic')->first();
        $trs = $statistic->filter('tr');
        $date = null;
        foreach ($trs as $tr){
            $match = new Match();
            $match->setDate($date);
            $match->setPlayer1($vova);

            /** @var \DOMElement $tr */
            $th = $tr->firstChild;


            if ($th->nodeName == 'th'){
                //todo: Дата
                $date = new \DateTime($th->firstChild->textContent);
            } else {
                //todo: Матч
                foreach ($tr->childNodes as $key => $item){


                    if($key == 1){
                        $scores = $item->textContent;
                        $myPoint = substr($scores, 0, 1);
                        $playerPoint = substr($scores, 2, 1);
                        $match->setPlayer1Points($myPoint);
                        $match->setPlayer2Points($playerPoint);
                    }

                    if ($key == 2){
                        $p2 = $item->textContent;
                        $lastname = explode(' ', $p2)[0];
                        $firstname = explode(' ', $p2)[1];
                        $playerExist = $em->getRepository('AppBundle:Player')
                            ->createQueryBuilder('p')
                            ->where('p.lastName =:lastname')
                            ->setParameter('lastname', $lastname)
                            ->getQuery()
                            ->getOneOrNullResult();
                        if (!$playerExist instanceof Player){
                            $playerExist = new Player();
                            $playerExist->setLastName($lastname);
                            $playerExist->setFirstName($firstname);
                            $em->persist($playerExist);
                        }
                        $match->setPlayer2($playerExist);
                    }

                }

            }
            $em->persist($match);
            $em->flush();
        }

    }
}