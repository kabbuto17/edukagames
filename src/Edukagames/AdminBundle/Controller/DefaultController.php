<?php

namespace Edukagames\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }
    
    public function showAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$archivos = $em->getRepository('AdminBundle:Archivo')->findAll(); // TODO TUDIAR CONSULTAS K TOY MAS K VERDE XD
    	
    	foreach ($archivos as $archivo ){
    		if ($archivo->getInforme()->getAlumno()->getId() == $id) {
    			$seleccionados[] = $archivo;
    		}
    	}
    	if($seleccionados != null)
    		ldd("");
    }
    
    public function getInformeDelAlumno()
    {
    	
    }
}
