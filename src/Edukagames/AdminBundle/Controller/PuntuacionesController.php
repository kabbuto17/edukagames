<?php
namespace Edukagames\AdminBundle\Controller;

use Symfony\Component\Validator\Constraints\Date;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Archivo controller.
 *
 */
class PuntuacionesController extends Controller
{
	public function showAction($id){
		$em = $this->getDoctrine()->getEntityManager();
		$juegos = $em->getRepository('AdminBundle:juego')->findAll();
		
		$puntuaciones1 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $id, 'Juego' => $juegos[0]),null,10);
		$puntuaciones2 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $id, 'Juego' => $juegos[1]),null,10);
		$puntuaciones3 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $id, 'Juego' => $juegos[2]),null,10);
		$puntuaciones4 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $id, 'Juego' => $juegos[3]),null,10);
		$puntuaciones5 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $id, 'Juego' => $juegos[4]),null,10);
		
		$puntuaciones  = array($puntuaciones1,$puntuaciones2,$puntuaciones3,$puntuaciones4,$puntuaciones5);
		
		
		return $this->render('AdminBundle:Puntuaciones:show.html.twig', array(
				'puntuaciones'      => $puntuaciones,
				'juegos'			=> $juegos,
		));
	}	
}
