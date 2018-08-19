<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Draw;
use AppBundle\Entity\Match;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Draw controller.
 *
 */
class DrawController extends Controller
{
    /**
     * Lists all draw entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $draws = $em->getRepository('AppBundle:Draw')->findAll();
        return $this->render('draw/index.html.twig', array(
            'draws' => $draws,
        ));
    }

    /**
     * Creates a new draw entity.
     *
     */
    public function newAction(Request $request)
    {
        $draw = new Draw();
        $form = $this->createForm('AppBundle\Form\DrawType', $draw);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($draw);
            $em->flush();
            $this->get('draw_creator')->createMatches($draw);
            return $this->redirectToRoute('draw_show', array('id' => $draw->getId()));
        }

        return $this->render('draw/new.html.twig', array(
            'draw' => $draw,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a draw entity.
     *
     */
    public function showAction(Draw $draw)
    {

        $matrix = [];
        foreach ($draw->getMatches() as $match) {
            /** @var Match $match */
            $matrix[$match->getDrawRound()][$match->getDrawRoundNumber()] = $match;
        }
        arsort($matrix);

        return $this->render('::draw.html.twig',
            [ 'rounds'=> $matrix, 'count_rounds' => count($matrix) ]
        );

        $deleteForm = $this->createDeleteForm($draw);

        return $this->render('draw/show.html.twig', array(
            'draw' => $draw,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing draw entity.
     *
     */
    public function editAction(Request $request, Draw $draw)
    {
        $deleteForm = $this->createDeleteForm($draw);
        $editForm = $this->createForm('AppBundle\Form\DrawType', $draw);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('draw_edit', array('id' => $draw->getId()));
        }

        return $this->render('draw/edit.html.twig', array(
            'draw' => $draw,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a draw entity.
     *
     */
    public function deleteAction(Request $request, Draw $draw)
    {
        $form = $this->createDeleteForm($draw);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($draw);
            $em->flush();
        }

        return $this->redirectToRoute('draw_index');
    }

    /**
     * Creates a form to delete a draw entity.
     *
     * @param Draw $draw The draw entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Draw $draw)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('draw_delete', array('id' => $draw->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
