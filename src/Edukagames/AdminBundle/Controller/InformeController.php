<?php

namespace Edukagames\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Edukagames\AdminBundle\Entity\Informe;
use Edukagames\AdminBundle\Form\InformeType;

/**
 * Informe controller.
 *
 */
class InformeController extends Controller
{
    /**
     * Lists all Informe entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Informe')->findAll();

        return $this->render('AdminBundle:Informe:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Informe entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Informe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Informe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Informe:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Informe entity.
     *
     */
    public function newAction()
    {
        $entity = new Informe();
        $form   = $this->createForm(new InformeType(), $entity);

        return $this->render('AdminBundle:Informe:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Informe entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Informe();
        $form = $this->createForm(new InformeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('informe_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Informe:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Informe entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Informe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Informe entity.');
        }

        $editForm = $this->createForm(new InformeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Informe:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Informe entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Informe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Informe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InformeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('informe_edit', array('id' => $id)));
        }

        return $this->render('AdminBundle:Informe:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Informe entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Informe')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Informe entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('informe'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
