<?php

namespace Edukagames\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
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
