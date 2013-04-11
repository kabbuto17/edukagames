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
		foreach ($juegos as $juego)
		{
			$puntuaciones[] = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $id, 'Juego' => $juego),array('fecha'=>'DESC'),10);
		}
// 		$query = $em->createQuery(
// 				"SELECT p, j.nombre FROM AdminBundle:Puntuacion p, AdminBundle:juego j
// 				WHERE p.Alumno = :id AND p.Juego = j.id
// 				ORDER BY p.Juego, p.Dificultad");
// 		$query->setParameter('id', $id);
// 		ldd($query->getArrayResult());
		return $this->render('AdminBundle:Puntuaciones:show.html.twig', array(
				'puntuaciones'      => $puntuaciones,
				'juegos'			=> $juegos,
		));
	}

	public function UltimasPuntuacionesAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$lasts = $em->getRepository('AdminBundle:Puntuacion')->findBy(array('Alumno'=>$id,),array('fecha'=>'DESC'),5);
		return $this->render('AdminBundle:Puntuaciones:UltimasPuntuaciones.html.twig', array(
				'lasts' => $lasts
				));

	}
}
