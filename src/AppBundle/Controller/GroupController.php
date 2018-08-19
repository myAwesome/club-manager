<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Group;
use AppBundle\Entity\Match;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Group controller.
 *
 */
class GroupController extends Controller
{
    /**
     * Lists all group entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groups = $em->getRepository('AppBundle:Group')->findAll();
        return $this->render('group/index.html.twig', array(
            'groups' => $groups,
        ));
    }

    /**
     * Creates a new group entity.
     *
     */
    public function newAction(Request $request)
    {
        $group = new Group();
        $form = $this->createForm('AppBundle\Form\GroupType', $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();
            $this->get('group_creator')->createMatches($group);
            return $this->redirectToRoute('group_show', array('id' => $group->getId()));
        }

        return $this->render('group/new.html.twig', array(
            'group' => $group,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a group entity.
     */
    public function showAction(Group $group)
    {
        $matrix = [];
        foreach ($group->getPlayers() as $i=>$playerI) {
            foreach ($group->getPlayers() as $j=>$playerJ) {
                if ($i == $j){
                    $matrix[$i][$j] = 'X';
                } else {
                    foreach ($group->getMatches() as $match){
                        if (
                            in_array($match->getPlayer1()->getId(), [$playerI->getId(), $playerJ->getId()]) &&
                            in_array($match->getPlayer2()->getId(), [$playerI->getId(), $playerJ->getId()])
                        ){
                            if ($match->getPlayer1()->getId() == $playerI->getId()){
                                $matrix[$i][$j] = $match->getPlayer1Points() .'/'. $match->getPlayer2Points();
                            } else {
                                $matrix[$i][$j] = $match->getPlayer2Points() .'/'. $match->getPlayer1Points();
                            }
                        }
                    }
                }
            }
        }


        $deleteForm = $this->createDeleteForm($group);
        return $this->render('group/show.html.twig', array(
            'group' => $group,
            'matrix' =>$matrix,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing group entity.
     *
     */
    public function editAction(Request $request, Group $group)
    {
        $deleteForm = $this->createDeleteForm($group);
        $editForm = $this->createForm('AppBundle\Form\GroupType', $group);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('group_edit', array('id' => $group->getId()));
        }

        return $this->render('group/edit.html.twig', array(
            'group' => $group,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a group entity.
     *
     */
    public function deleteAction(Request $request, Group $group)
    {
        $form = $this->createDeleteForm($group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($group);
            $em->flush();
        }

        return $this->redirectToRoute('group_index');
    }

    /**
     * Creates a form to delete a group entity.
     *
     * @param Group $group The group entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Group $group)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('group_delete', array('id' => $group->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
