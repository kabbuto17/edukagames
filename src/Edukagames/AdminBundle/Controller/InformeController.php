<?php

namespace Edukagames\AdminBundle\Controller;

use Edukagames\UserBundle\Util\SaveEraseFile;

use CG\Tests\Generator\Fixture\Entity;

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
    public function indexAction($id, $count)
    {
        $em = $this->getDoctrine()->getManager();
		$informes = $em->getRepository('AdminBundle:Informe')->findBy(array('Alumno' => $id), array('fecha' => 'DESC'),($count>0)?$count:null);
		if($count >0 ){
		return $this->render('AdminBundle:Informe:indexComprimido.html.twig', array(
				'informes' => $informes,
				'id'	=> $id,
		));			
		}else{
	    return $this->render('AdminBundle:Informe:index.html.twig', array(
            'informes' => $informes,
        	'id'	=> $id,
        ));
		}
	}

    /**
     * Finds and displays a Informe entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $informe = $em->getRepository('AdminBundle:Informe')->find($id);

        if (!$informe) {
            throw $this->createNotFoundException('Unable to find Informe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Informe:show.html.twig', array(
            'informe'      => $informe,
            'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to create a new Informe entity.
     *
     */
    public function newAction($id)
    {
        $informe = new Informe();
        $form   = $this->createForm(new InformeType(), $informe);
        $alumno = $this->getDoctrine()->getEntityManager()->getRepository('UserBundle:Alumno')->find($id);
      
        return $this->render('AdminBundle:Informe:new.html.twig', array(
            'informe' => $informe,
            'form'   => $form->createView(),
        	'alumno' => $alumno
        ));
		
    }

    /**
     * Creates a new Informe entity.
     *
     */
    public function createAction(Request $request,$id)
    {
        $informe  = new Informe();
        $form = $this->createForm(new InformeType(), $informe);
        $alumno = $this->getDoctrine()->getEntityManager()->getRepository('UserBundle:Alumno')->find($id);

        $form->bind($request);
	    if ($form->isValid()) {
	    	$em = $this->getDoctrine()->getManager();
	       	$filename = $_FILES ["edukagames_adminbundle_informetype"]["name"]["nombreInforme"];
	       	$tmp_filename = $_FILES["edukagames_adminbundle_informetype"]["tmp_name"]["nombreInforme"];
	       	$destination = "uploads/".$alumno->getId()."/informes";
	       	$informe->setNombreInforme($filename);
	       	$informe->setAlumno($alumno);

	       	SaveEraseFile::saveFile($destination, $tmp_filename, $filename);
	
	        $em->persist($informe);
	        $em->flush();
	        $this->get("session")->getFlashBag()->add('success', 'Se añadio correctamente el informe '.$filename.' al usuario '.$alumno->getNombreCompleto().'.');
	        return $this->redirect($this->generateUrl('alumnos_details', array('id' => $id)));
        }

        return $this->render('AdminBundle:Informe:new.html.twig', array(
            'alumno' => $alumno,
            'form'   => $form->createView(),
        	'informe'=> $informe,
        ));
    }

    /**
     * Edits an existing Informe entity.
     *
     */
    public function updateAction($id)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$informe = $em->getRepository('AdminBundle:Informe')->find($id);
		$informeAntiguo = $informe->getNombreInforme();
		if (!$informe) {
			throw $this->createNotFoundException("No se encontro la entidad(update)");
		}

		$form = $this->createForm(new InformeType(),$informe);
		$request = $this->getRequest()->getMethod();
		
		if ($request == "POST") {
			$filename = $_FILES ["edukagames_adminbundle_informetype"]["name"]["nombreInforme"];
        	$tmp_filename = $_FILES["edukagames_adminbundle_informetype"]["tmp_name"]["nombreInforme"];
        	$destination = "uploads/".$informe->getAlumno()->getId()."/informes";
 			$form -> bindRequest($this->getRequest());
			if ($form->isValid()) {
// 				ldd($filename,$tmp_filename,$destination);
				if ($form->getData()->getNombreInforme() != null) {
					$informe->setNombreInforme($form->getData()->getNombreInforme()->getClientOriginalName());
					if($informeAntiguo != $filename) {
						SaveEraseFile::eraseFile($destination."/".$informeAntiguo);
					}
					SaveEraseFile::saveFile($destination, $tmp_filename, $filename);
				}
				else{
						$informe->setNombreInforme($informeAntiguo);
					}
				
				$em->persist($informe);
				$em->flush();
				$this->get("session")->getFlashBag()->add('success', 'Se actualizo correctamente el informe '.$informe->getNombreInforme().' al usuario '.$informe->getAlumno()->getNombreCompleto().'.');
				return $this->redirect($this->generateUrl('alumnos_details', array('id' => $informe->getAlumno()->getId())));
			}
		}

		return $this->render('AdminBundle:Informe:edit.html.twig', array(
				'informe'      => $informe,
				'edit_form'   => $form->createView(),
		));
    }

    /**
     * Deletes a Informe entity.
     *
     */
    public function deleteAction($id)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$informe = $em->getRepository('AdminBundle:Informe')->find($id);
		$directorio = "uploads/".$informe->getAlumno()->getId()."/informes";
		$dir = $directorio."/".$informe->getNombreInforme();
		SaveEraseFile::eraseFile($dir);
		$em->remove($informe);
		$em->flush();
		$this->get("session")->getFlashBag()->add('success', 'Se elimino correctamente el informe '.$informe->getNombreInforme().' al usuario '.$informe->getAlumno()->getNombreCompleto().'.');
		return $this->redirect($this->generateUrl('alumnos_details', array('id' => $informe->getAlumno()->getId())));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
