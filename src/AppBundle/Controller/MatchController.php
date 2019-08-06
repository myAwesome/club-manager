<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Match;
use AppBundle\Entity\Player;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Match controller.
 *
 */
class MatchController extends Controller
{
    /**
     * Lists all match entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $matches = $em->getRepository('AppBundle:Match')->findAll();

        return $this->render('match/index.html.twig', array(
            'matches' => $matches,
        ));
    }

    public function listByPlayerAction(Player $player)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $matches = $em->getRepository('AppBundle:Match')
            ->byPlayer($player);


        return $this->render('match/index.html.twig', array(
            'matches' => $matches,
        ));
    }

    public function headToHeadAction(Player $player1, Player $player2)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $matches = $em->getRepository('AppBundle:Match')->headTohead($player1, $player2);


        return $this->render('match/index.html.twig', array(
            'matches' => $matches,
        ));
    }


    /**
     * Creates a new match entity.
     *
     */
    public function newAction(Request $request)
    {
        $match = new Match();
        $em = $this->getDoctrine()->getManager();

        $p1 = $em->find('AppBundle:Player', 1);

        $match->setPlayer1($p1);

        $match->setDate(new \DateTime());
        $form = $this->createForm('AppBundle\Form\MatchType', $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($match);
            $em->flush();

            return $this->redirectToRoute('match_show', array('id' => $match->getId()));
        }

        return $this->render('match/new.html.twig', array(
            'match' => $match,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a match entity.
     *
     */
    public function showAction(Match $match)
    {
        $deleteForm = $this->createDeleteForm($match);

        return $this->render('match/show.html.twig', array(
            'match' => $match,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing match entity.
     *
     */
    public function editAction(Request $request, Match $match)
    {
        $deleteForm = $this->createDeleteForm($match);
        $editForm = $this->createForm('AppBundle\Form\MatchType', $match);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('match_edit', array('id' => $match->getId()));
        }

        return $this->render('match/edit.html.twig', array(
            'match' => $match,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a match entity.
     *
     */
    public function deleteAction(Request $request, Match $match)
    {
        $form = $this->createDeleteForm($match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($match);
            $em->flush();
        }

        return $this->redirectToRoute('match_index');
    }

    /**
     * Creates a form to delete a match entity.
     *
     * @param Match $match The match entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Match $match)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('match_delete', array('id' => $match->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
