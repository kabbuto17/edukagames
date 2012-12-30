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

    public function SeachAjaxAction($param){
    	$em = $this->getDoctrine()->getEntityManager();
    	$query = $em->createQuery(
    			'SELECT alumno FROM UserBundle:Alumno alumno 
    			WHERE alumno.userName 
    			LIKE :search ORDER BY alumno.userName ASC')->setParameter('search', '%'.$param.'%');
    	$result = $query->getResult();
    	
    	return $this->render('AdminBundle:Default:search.html.twig', array('result' => $result, 'param' => $param));
    }
}
