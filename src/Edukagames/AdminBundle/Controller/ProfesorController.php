<?php

namespace Edukagames\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Edukagames\AdminBundle\Entity\Profesor;
use Edukagames\AdminBundle\Form\ProfesorType;

/**
 * Profesor controller.
 *
 */
class ProfesorController extends Controller
{
    /**
     * Lists all Profesor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Profesor')->findAll();

        return $this->render('AdminBundle:Profesor:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Profesor entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Profesor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profesor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Profesor:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Profesor entity.
     *
     */
    public function newAction()
    {
        $entity = new Profesor();
        $form   = $this->createForm(new ProfesorType(), $entity);

        return $this->render('AdminBundle:Profesor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Profesor entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Profesor();
        $form = $this->createForm(new ProfesorType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setSalt("aleatoriototalmuaahahahhahaha");
            $encoder = $enconder = $this->container->get('security.encoder_factory')->getEncoder($entity);
            $passwordEncriptado= $encoder->encodePassword($form->getData()->getPassword(),$entity->getSalt());
            $entity->setPassword($passwordEncriptado);

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('profesor_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Profesor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Profesor entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Profesor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profesor entity.');
        }

        $editForm = $this->createForm(new ProfesorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Profesor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Profesor entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Profesor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profesor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ProfesorType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
        	$encoder = $enconder = $this->container->get('security.encoder_factory')->getEncoder($entity);
        	$passwordEncriptado= $encoder->encodePassword($editForm->getData()->getPassword(),$entity->getSalt());
        	$entity->setPassword($passwordEncriptado);
        	
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('profesor_edit', array('id' => $id)));
        }

        return $this->render('AdminBundle:Profesor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Profesor entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Profesor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Profesor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('profesor'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
