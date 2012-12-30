<?php

namespace Edukagames\AdminBundle\Controller;

use Symfony\Component\Validator\Constraints\Date;

use Edukagames\UserBundle\UserBundle;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Edukagames\AdminBundle\Entity\Archivo;
use Edukagames\AdminBundle\Entity\Fichero;
use Edukagames\AdminBundle\Form\ArchivoType;

/**
 * Archivo controller.
 *
 */
class ArchivoController extends Controller
{
	public function showAction($id){
		$em = $this->getDoctrine()->getEntityManager();
		$ficheros = $em->getRepository('AdminBundle:Fichero')->findby(array('alumno' => $id));
		foreach($ficheros as $fichero){
			$archivos = $fichero;
		}
		ldd($archivos);
		return $this->render('AdminBundle:Archivo:index.html.twig', array(
				'archivos' => $archivos
				));
	}
}
