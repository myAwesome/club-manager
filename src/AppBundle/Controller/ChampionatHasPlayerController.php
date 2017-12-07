<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChampionatHasPlayer;
use AppBundle\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Championathasplayer controller.
 *
 */
class ChampionatHasPlayerController extends Controller
{
    /**
     * Lists all championatHasPlayer entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');

        $championatHasPlayersQB = $em
            ->getRepository('AppBundle:ChampionatHasPlayer')
            ->createQueryBuilder('chp');

        if (null !== $request->get('champ')) {
            $championatHasPlayersQB
                ->where('chp.championat = :champ')
                ->setParameter('champ', $request->get('champ'));
        }

        $championatHasPlayers = $championatHasPlayersQB
            ->getQuery()
            ->getResult();

        return $this->render('championathasplayer/index.html.twig', array(
            'championatHasPlayers' => $championatHasPlayers,
        ));
    }

    /**
     * Creates a new championatHasPlayer entity.
     *
     */
    public function newAction(Request $request)
    {
        $championatHasPlayer = new Championathasplayer();
        $form = $this->createForm('AppBundle\Form\ChampionatHasPlayerType', $championatHasPlayer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($championatHasPlayer);
            $em->flush();

            return $this->redirectToRoute('championathasplayer_show', array('id' => $championatHasPlayer->getId()));
        }

        return $this->render('championathasplayer/new.html.twig', array(
            'championatHasPlayer' => $championatHasPlayer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a championatHasPlayer entity.
     *
     */
    public function showAction(ChampionatHasPlayer $championatHasPlayer)
    {
        $deleteForm = $this->createDeleteForm($championatHasPlayer);

        return $this->render('championathasplayer/show.html.twig', array(
            'championatHasPlayer' => $championatHasPlayer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing championatHasPlayer entity.
     *
     */
    public function editAction(Request $request, ChampionatHasPlayer $championatHasPlayer)
    {
        $deleteForm = $this->createDeleteForm($championatHasPlayer);
        $editForm = $this->createForm('AppBundle\Form\ChampionatHasPlayerType', $championatHasPlayer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('championathasplayer_edit', array('id' => $championatHasPlayer->getId()));
        }

        return $this->render('championathasplayer/edit.html.twig', array(
            'championatHasPlayer' => $championatHasPlayer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a championatHasPlayer entity.
     *
     */
    public function deleteAction(Request $request, ChampionatHasPlayer $championatHasPlayer)
    {
        $form = $this->createDeleteForm($championatHasPlayer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($championatHasPlayer);
            $em->flush();
        }

        return $this->redirectToRoute('championathasplayer_index');
    }

    /**
     * Creates a form to delete a championatHasPlayer entity.
     *
     * @param ChampionatHasPlayer $championatHasPlayer The championatHasPlayer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ChampionatHasPlayer $championatHasPlayer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('championathasplayer_delete', array('id' => $championatHasPlayer->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
