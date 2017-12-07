<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Championat;
use AppBundle\Entity\Match;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Championat controller.
 *
 */
class ChampionatController extends Controller
{
    /**
     * Lists all championat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $championats = $em->getRepository('AppBundle:Championat')->findAll();

        return $this->render('championat/index.html.twig', array(
            'championats' => $championats,
        ));
    }

    /**
     * Creates a new championat entity.
     *
     */
    public function newAction(Request $request)
    {
        $championat = new Championat();
        $form = $this->createForm('AppBundle\Form\ChampionatType', $championat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($championat);
            $em->flush();

            return $this->redirectToRoute('championat_show', array('id' => $championat->getId()));
        }

        return $this->render('championat/new.html.twig', array(
            'championat' => $championat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a championat entity.
     *
     */
    public function showAction(Championat $championat)
    {
        $deleteForm = $this->createDeleteForm($championat);

        return $this->render('championat/show.html.twig', array(
            'championat' => $championat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing championat entity.
     *
     */
    public function editAction(Request $request, Championat $championat)
    {
        $deleteForm = $this->createDeleteForm($championat);
        $editForm = $this->createForm('AppBundle\Form\ChampionatType', $championat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('championat_edit', array('id' => $championat->getId()));
        }

        return $this->render('championat/edit.html.twig', array(
            'championat' => $championat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a championat entity.
     *
     */
    public function deleteAction(Request $request, Championat $championat)
    {
        $form = $this->createDeleteForm($championat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($championat);
            $em->flush();
        }

        return $this->redirectToRoute('championat_index');
    }

    /**
     * Creates a form to delete a championat entity.
     *
     * @param Championat $championat The championat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Championat $championat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('championat_delete', array('id' => $championat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // --------------------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------

    public function playersAction(Championat $championat)
    {
        $championatHasPlayers = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('AppBundle:ChampionatHasPlayer')
            ->findBy(['championat' => $championat], ['place'=> 'asc']);

        return $this->render('championathasplayer/index.html.twig', array(
            'championatHasPlayers' => $championatHasPlayers,
        ));
    }

    public function groupsAction(Championat $championat)
    {
        $groups = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Group')
            ->findBy(['championat' => $championat]);

        $groupsMatrix = [];
        $playersList = [];

        foreach ($groups as $group) {
            $plyers = $group->getPlayers();
            $matches = $group->getMatches();
            $groupMatrix = [];
            foreach ($plyers as $plyer) {
                $playersList[$plyer->getId()] = $plyer;
                $i = 0;
                foreach ($plyers as $opponent) {
                    if ($plyer === $opponent) {
                        $groupMatrix[$plyer->getId()][$i] = null;
                    }
                    foreach ($matches as $m) {
                        /** @var Match $m */
                        if ($m->getPlayer1() === $plyer && $m->getPlayer2() === $opponent)
                        {
                            $groupMatrix[$plyer->getId()][$i] = sprintf('%s:%s', $m->getPlayer1Points(), $m->getPlayer2Points());
                        }

                        if ($m->getPlayer1() === $opponent && $m->getPlayer2() === $plyer)
                        {
                            $groupMatrix[$plyer->getId()][$i] = sprintf('%s:%s', $m->getPlayer2Points(), $m->getPlayer1Points());
                        }

                    }
                    $i++;
                }
            }
            $groupsMatrix[$group->getId()] = $groupMatrix;
        }

        return $this->render('group/index.html.twig', array(
            'groups'        => $groups,
            'groupsMatrix'  => $groupsMatrix,
            'playersList'   => $playersList
        ));
    }

    public function drawAction(Championat $championat)
    {
        $em = $this->getDoctrine()->getManager();

        $draws = $em->getRepository('AppBundle:Draw')->findBy(['championat' => $championat]);

        foreach ($draws as $draw) {
            $roundsNumber = (int)log($draw->getCapacity(), 2);
            $rounds = [];
            for ($i = $roundsNumber; $i>0; $i-- ){
                foreach ($draw->getMatches() as $m){
                    if ($m->getDrawRound() === $i){
                        $rounds[$i][] = $m;
                    }
                }
            }
        }

        return $this->render('draw/index.html.twig', array(
            'rounds' => $rounds,
        ));
    }

}
