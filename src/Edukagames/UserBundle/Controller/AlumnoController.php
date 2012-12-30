<?php

namespace Edukagames\UserBundle\Controller;

use Symfony\Component\Validator\Constraints\Length;

use Doctrine\ORM\EntityManager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Edukagames\UserBundle\Util\SaveFile;
use Edukagames\UserBundle\Entity\Alumno;
use Edukagames\UserBundle\Form\AlumnoType;

/**
 * Alumno controller.
 *
 */
class AlumnoController extends Controller
{
    /**
     * Lists all Alumno entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UserBundle:Alumno')->findAll();

        return $this->render('UserBundle:Alumno:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Alumno entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:Alumno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alumno entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UserBundle:Alumno:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Alumno entity.
     *
     */
    public function newAction()
    {
        $entity = new Alumno();
        $form   = $this->createForm(new AlumnoType(), $entity);

        return $this->render('UserBundle:Alumno:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Alumno entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Alumno();
        $form = $this->createForm(new AlumnoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $encoder = $this->get('security.encoder_factory')->getEncoder($entity);
            $entity->setSalt(md5(time()));
            $passRAW = $entity->getPassword();
            $passCOD = $encoder->encodePassword($passRAW, $entity->getSalt());
            $entity->setPassword($passCOD);
            $entity->setFoto("defaultprofile.png");
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alumno_show', array('id' => $entity->getId())));
        }

        return $this->render('UserBundle:Alumno:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Alumno entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:Alumno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alumno entity.');
        }

        $editForm = $this->createForm(new AlumnoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UserBundle:Alumno:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Alumno entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:Alumno')->find($id);
        $fotoOrin = $entity->getFoto();
        $passOrin = $entity->getPassword();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alumno entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AlumnoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
        	$encoder = $this->get('security.encoder_factory')->getEncoder($entity);
        	$passRAW = $entity->getPassword();
        	$passCOD = $encoder->encodePassword($passRAW, $entity->getSalt());
        	
        	if ($editForm->getData()->getPassword() == NULL)
         		$entity->setPassword($passOrin);
         	else 
         		$entity->setPassword($passCOD);

         	if($editForm->getData()->getFoto() != null){
         		$nombreArchivo = $editForm->getData()->getFoto()->getClientOriginalName();
         		$entity->setFoto($nombreArchivo);
         		$raizImagen = 'bundles/user/img/'.$id;
          		SaveFile::saveFile($raizImagen, $_FILES['edukagames_userbundle_alumnotype']['tmp_name']["foto"], $nombreArchivo);
           	} else {
          		$entity->setFoto($fotoOrin);
         	}
         	
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alumno_edit', array('id' => $id)));
        }

        return $this->render('UserBundle:Alumno:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Alumno entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UserBundle:Alumno')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Alumno entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('alumno'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
