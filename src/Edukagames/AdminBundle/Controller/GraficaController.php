<?php

namespace Edukagames\AdminBundle\Controller;

use Edukagames\AdminBundle\Form\GraficaType;

use Ladybug\Processor\Zend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;

/**
 * Grafica controller.
 *
 */
class GraficaController extends Controller
{
	
// 	public function indiceAction()
// 	{
// 		$em = $this->getDoctrine()->getEntityManager();
// // 		$puntuaciones = $em->getRepository('AdminBundle:Puntuacion')-> findby(array('Alumno'=>1));
// 		$juego = $em->getRepository('AdminBundle:Juego')->findAll();
// 		$form = $this->createForm(new GraficaType(), $juego);
		
// 		return $this->render('AdminBundle:Grafica:index.html.twig', array(
// 				'form' => $form->createView()));
// 	}

//     public function chartAction()
//     {
//         $em = $this->getDoctrine()->getEntityManager();
//         $alumno = $em->getRepository('UserBundle:Alumno')->find(64);
//         $puntuacionesJuego1 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>7));//,array('Fase' => 'ASC'));
//         $puntuacionesJuego2 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>8));
//         $puntuacionesJuego3 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>9));
//         $puntuacionesJuego4 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>10));
//         $puntuacionesJuego5 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>11));
// 		//ldd($puntuacionesJuego1);
// 		$datos = array();
// 		//TODO sacar numero de niveles por nivel
// 		for($i = 0; $i<=10; $i++){
// 			$datos[$i] = 0;
// 		}
//         foreach ($puntuacionesJuego1 as $puntuacion){
// 			if(array_key_exists($puntuacion->getDificultad(), $datos)){
// 				if($datos[$puntuacion->getDificultad()] < $puntuacion->getPuntos())
// 					$datos[$puntuacion->getDificultad()] = $puntuacion->getPuntos();
// 			}else{
// 				$datos[$puntuacion->getDificultad()] = $puntuacion->getPuntos();
// 			}
//         }
//         $series = array(
//         		array("name" => "Data Serie Name",    "data" => $datos)
//         );
        
// 		$ob = new Highchart();
// 		$ob->chart->renderTo('container');
// 		$ob->chart->type('column');
// 		$ob->title->text('Nivel frente a puntos');
// 		$ob->legend->enabled(false);
// 		$ob->series($series);
		
//         return $this->render('::your_template.html.twig', array(
//             'chart' => $ob
//         ));
//     }

	/**
	 * Busca en $array (Multidimensional) si existe el valor $id y devuelve el indice o false si no existe.
	 */
	private function searchForId($id, $array) {
		foreach ($array as $key => $val) {
			if ($val['id'] === $id) {
				return $key;
			}
		}
		return false;
	}
	public function showAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
				"SELECT DISTINCT j.id , j.nombre , p.Dificultad 
				FROM AdminBundle:Juego j , AdminBundle:Puntuacion p 
				WHERE j.id = p.Juego AND p.Alumno=:id"
				);
		$query->setParameter(':id', $id);
		$juegos = array();
		foreach ($query->getArrayResult() as $juego)
		{
			$key = self::searchForId($juego['id'], $juegos);
			if($key !== false)//existe la id en res y añadimos la dificultad en donde le corresponda.
			{
				array_push($juegos[$key]['Dificultad'], $juego['Dificultad']);
			}
			else
			{
				$aux = array(
						'id' => $juego['id'],
						'nombre' => $juego['nombre'],
						'Dificultad' => array($juego['Dificultad'])
				);
				array_push($juegos, $aux);
			}
		}
		return $this->render('AdminBundle:Grafica:show.html.twig', array(
				'juegos' => $juegos,
				'id'	=> $id
				));
	}
	/*
	 * Pinta la grafica en un div dado, para un id alumno, una dificultad y un juego.
	 * 
	 * */
	public function DrawChartAction($div, $id, $dificultad, $id_juego)
	{
		$em = $this->getDoctrine()->getEntityManager();
		//sacamos las ultimas 15 puntuaciones de un alumno y de un juego segun la dificultad.
		//TODO optimizar las busquedas de puntuaciones, en la pestaña puntuaciones tb se sacan, si se sacan aqui tb al final se hacen muchas consultas a la bd...
 		$puntuacion = $em->getRepository('AdminBundle:Puntuacion')->findBy(array('Alumno' => $id, 'Juego' => $id_juego ,'Dificultad' => $dificultad),array('fecha' => 'DESC'),15);
		$series = array(
 				array(
 						'name' => 'Puntos',
 						'type' => 'column',
 						'data' =>  array(),
 				),
 				array(
 						'name' => 'Fallos',
 						'type' => 'spline',
 						'data' =>  array(),
 				),
 				array(
 						'name' => 'Aciertos',
 						'type' => 'spline',
 						'data' =>  array(),
 				),
 		);
 		$categories = array();
 		foreach ($puntuacion as $punt)
 		{
 			array_push($series[0]['data'], $punt->getPuntos());
 			array_push($series[2]['data'], $punt->getAciertos());
 			array_push($series[1]['data'], $punt->getFallos());
 			array_push($categories, $punt->getFecha()->format('d M Y H:i'));
 			
 		}
 		$ob = new Highchart();
 		$ob->chart->renderTo($div); // The #id of the div where to render the chart
 		$ob->chart->type('spline');
 		$ob->title->text('');
 		$ob->xAxis->categories($categories);
 		$ob->yAxis(array('title' => ''));
 		$ob->legend->enabled(true);
 		$ob->series($series);

		return $this->render('::your_template.html.twig', array(
				'chart' => $ob,
				'div'	=> $div
		));
		
		
	}
}
