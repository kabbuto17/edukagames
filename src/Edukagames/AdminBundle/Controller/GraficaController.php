<?php

namespace Edukagames\AdminBundle\Controller;

use Edukagames\AdminBundle\Form\GraficaType;

use Ladybug\Processor\Zend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Zend\Json\Expr;

/**
 * Archivo controller.
 *
 */
class GraficaController extends Controller
{
	
	public function indiceAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
// 		$puntuaciones = $em->getRepository('AdminBundle:Puntuacion')-> findby(array('Alumno'=>1));
		$juego = $em->getRepository('AdminBundle:Juego')->findAll();
		$form = $this->createForm(new GraficaType(), $juego);
		
		return $this->render('AdminBundle:Grafica:index.html.twig', array(
				'form' => $form->createView()));
	}

    public function chartAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $alumno = $em->getRepository('UserBundle:Alumno')->find(1);
        $puntuacionesJuego1 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>1),array('Fase' => 'ASC'));
        $puntuacionesJuego2 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>2));
        $puntuacionesJuego3 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>3));
        $puntuacionesJuego4 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>4));
        $puntuacionesJuego5 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>5));
		
		$datos = array();
		//TODO sacar numero de niveles por nivel
		for($i = 0; $i<=10; $i++){
			$datos[$i] = 0;
		}
        foreach ($puntuacionesJuego1 as $puntuacion){
			if(array_key_exists($puntuacion->getFase(), $datos)){
				if($datos[$puntuacion->getFase()] < $puntuacion->getPuntos())
					$datos[$puntuacion->getFase()] = $puntuacion->getPuntos();
			}else{
				$datos[$puntuacion->getFase()] = $puntuacion->getPuntos();
			}
        }
        $series = array(
        		array("name" => "Data Serie Name",    "data" => $datos)
        );
        
		$ob = new Highchart();
		$ob->chart->renderTo('container');
		$ob->chart->type('column');
		$ob->title->text('Nivel frente a puntos');
		$ob->legend->enabled(false);
		$ob->series($series);
		
        return $this->render('::your_template.html.twig', array(
            'chart' => $ob
        ));
    }
}
