<?php

namespace Edukagames\AdminBundle\Controller;

use Symfony\Component\Validator\Constraints\Date;

use Edukagames\UserBundle\UserBundle;

use Edukagames\UserBundle\Util\SaveFile;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Edukagames\AdminBundle\Entity\Archivo;
use Edukagames\AdminBundle\Form\ArchivoType;

/**
 * Archivo controller.
 *
 */
class ArchivoController extends Controller
{
    /**
     * Lists all Archivo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Archivo')->findAll();

        return $this->render('AdminBundle:Archivo:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Archivo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Archivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Archivo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Archivo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Archivo entity.
     *
     */
    public function newAction()
    {
        $entity = new Archivo();
        $form   = $this->createForm(new ArchivoType(), $entity);

        return $this->render('AdminBundle:Archivo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Archivo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Archivo();
        $form = $this->createForm(new ArchivoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

			$fileName =$_FILES ["edukagames_adminbundle_archivotype"] ["name"]["nombreArchivo"];
			$fileName_temp = $_FILES["edukagames_adminbundle_archivotype"] ["tmp_name"]["nombreArchivo"];
// 			Util::SaveFile("/uploads/",$fileName_temp,$fileName); TODO	 mirar porke no me pilla la clase savefile
// 			ldd($form);
			if(!file_exists('uploads/')){
				mkdir($destination);
			}
			move_uploaded_file($fileName_temp, 'uploads/'.$fileName);
// mirar porque no me pilla la clase savefile de util
			$entity->setSalt(md5(time()));
			$entity->setNombreArchivo($fileName);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('archivo_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Archivo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Archivo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Archivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Archivo entity.');
        }

        $editForm = $this->createForm(new ArchivoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Archivo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Archivo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Archivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Archivo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ArchivoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('archivo_edit', array('id' => $id)));
        }

        return $this->render('AdminBundle:Archivo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Archivo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Archivo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Archivo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('archivo'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
