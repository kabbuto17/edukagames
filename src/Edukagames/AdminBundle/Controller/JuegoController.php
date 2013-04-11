<?php

namespace Edukagames\AdminBundle\Controller;

use Edukagames\UserBundle\Util\SaveEraseFile;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Edukagames\AdminBundle\Entity\Juego;
use Edukagames\AdminBundle\Form\JuegoType;

/**
 * Juego controller.
 *
 */
class JuegoController extends Controller
{
    /**
     * Lists all Juego entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AdminBundle:Juego')->findAll();

        return $this->render('AdminBundle:Juego:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Juego entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Juego')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Juego entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Juego:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Juego entity.
     *
     */
    public function newAction()
    {
        $entity = new Juego();
        $form   = $this->createForm(new JuegoType(), $entity);

        return $this->render('AdminBundle:Juego:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Juego entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Juego();
        $form = $this->createForm(new JuegoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $foto = $form->getData()->getImagen()->getClientOriginalName();
            $entity->setImagen($foto);
            $raizFoto = 'Juegos/'. str_replace(' ', '', $entity->getNombre()).'/';
            //ldd($_FILES);
            SaveEraseFile::saveFile($raizFoto, $_FILES['edukagames_adminbundle_juegotype']['tmp_name']["imagen"], $foto);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('juego')); //, array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Juego:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Juego entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Juego')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Juego entity.');
        }

        $editForm = $this->createForm(new JuegoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Juego:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Juego entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AdminBundle:Juego')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Juego entity.');
        }
		$imgenOri = $entity->getImagen();
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new JuegoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
        	if($editForm->getData()->getImagen() != null){
        		$nombreArchivo = $editForm->getData()->getImagen()->getClientOriginalName();
        		$entity->setImagen($nombreArchivo);
        		$raizImagen = 'Juegos/'. str_replace(' ', '', $entity->getNombre()).'/';
        		SaveEraseFile::saveFile($raizImagen, $_FILES['edukagames_adminbundle_juegotype']['tmp_name']["imagen"], $nombreArchivo);
        	} else {
        		$entity->setImagen($imgenOri);
        	}
        	$em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('juego_edit', array('id' => $id)));
        }

        return $this->render('AdminBundle:Juego:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Juego entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AdminBundle:Juego')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Juego entity.');
            }
            $directorio = "Juegos/".str_replace(' ', '', $entity->getNombre())."/";
            $dir = $directorio."/".$entity->getImagen();
            SaveEraseFile::eraseFile($dir);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('juego'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
