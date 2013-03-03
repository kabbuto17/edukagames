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
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $informes = $em->getRepository('AdminBundle:Informe')->findBy(array('Alumno' => $id));
        //TODO estudiar si es necesario $alumno
        $alumno = $em->getRepository('UserBundle:Alumno')->find($id);

        return $this->render('AdminBundle:Informe:index.html.twig', array(
            'informes' => $informes,
        	'alumno' => $alumno
        ));
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
        $em = $this->getDoctrine()->getEntityManager();
        $alumno = $em->getRepository('UserBundle:Alumno')->find($id);
        $request = $this->getRequest();

        $form->bindRequest($request);
        if ($form->isValid()) {
        	$filename = $_FILES ["edukagames_adminbundle_informetype"]["name"]["nombreInforme"];
        	$tmp_filename = $_FILES["edukagames_adminbundle_informetype"]["tmp_name"]["nombreInforme"];
        	$destination = "uploads/".$_POST["edukagames_adminbundle_informetype"]["alumno"]."/informes";
        	$informe->setNombreInforme($filename);

        	$informe->setAlumno($alumno);

        	SaveEraseFile::saveFile($destination, $tmp_filename, $filename);

        	$em->persist($informe);
        	$em->flush();

        	return $this->redirect($this->generateUrl('informe_show', array('id' => $entity->getId())));
        }
        
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
        $em = $this->getDoctrine()->getEntityManager();
        $alumno = $em->getRepository('UserBundle:Alumno')->find($id);
        if ($request->isMethod('POST')) {
        	$form->bind($request);
	        if ($form->isValid()) {
	        	$filename = $_FILES ["edukagames_adminbundle_informetype"]["name"]["nombreInforme"];
	        	$tmp_filename = $_FILES["edukagames_adminbundle_informetype"]["tmp_name"]["nombreInforme"];
	        	$destination = "uploads/".$alumno->getId()."/informes";
	        	$informe->setNombreInforme($filename);
	        	$informe->setAlumno($alumno);
	
	        	SaveEraseFile::saveFile($destination, $tmp_filename, $filename);
	
	            $em->persist($informe);
	            $em->flush();
				
	            return $this->redirect($this->generateUrl('informe_show', array('id' => $alumno->getId())));
        	}
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
				return $this->redirect($this->generateUrl('informe_show', array('id' => $informe->getId())));
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
		return $this->redirect($this->generateUrl('informe', array('id' => $informe->getAlumno()->getId())));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
