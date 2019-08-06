<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Draw;
use AppBundle\Entity\Group;
use AppBundle\Entity\Ranking;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/sandbox/{ranking}", name="sandbox")
     */
    public function sandboxAction(Ranking $ranking)
    {
        $res = $this->get('ranking_builder')->build($ranking);
        return $this->render('::ranking.html.twig', ['players' => $res]);

    }


    /**
     * @Route("/", name="index")
     */
    public function homeAction()
    {
        return $this->render('::home.html.twig');
    }


//    /**
//     * @Route("/", name="homepage")
//     */
//    public function _indexAction(Request $request)
//    {
//        $em = $this->get('doctrine.orm.entity_manager');
//
//        $repo = $em->getRepository('AppBundle:Match');
//        $matches =
//            $repo->createQueryBuilder('m')
//            ->where('m.draw =:dr')
//             ->orderBy('m.drawRound', 'desc')
//             ->addOrderBy('m.drawRoundNumber')
//            ->setParameter('dr', 1)
//            ->getQuery()
//            ->getResult();
//
//
//        return $this->render('::draw.html.twig',
//            [
//                'rounds'   => [
//                    ['6-3', '6-3', '6-3', '6-3'],
//                    ['6-1', '6-4'],
//                    ['6-2']
//                ]
//            ]);
//    }

    private function draw_mathes()
    {
        // Create matches for draw
        $em = $this->get('doctrine.orm.entity_manager');
        $champ = $em->find("AppBundle:Championat", 1);

        $draw = new Draw();
        $draw->setChampionat($champ);
        $draw->setCapacity(16);
        $em->persist($draw);
        $em->flush();

        $this->get('draw_creator')->createMatches($draw);
        var_dump(__LINE__);die;
    }
}
