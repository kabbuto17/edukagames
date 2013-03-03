<?php

namespace Edukagames\AdminBundle\Controller;

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

    public function chartAction()
    {
        // Chart
        $em = $this->getDoctrine()->getEntityManager();
        $alumno = $em->getRepository('UserBundle:Alumno')->find(1);
        $puntuacionesJuego1 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>1));
        $puntuacionesJuego2 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>2));
        $puntuacionesJuego3 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>3));
        $puntuacionesJuego4 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>4));
        $puntuacionesJuego5 = $em->getRepository('AdminBundle:Puntuacion')->findby(array('Alumno' => $alumno, 'Juego'=>5));
        $nivel = array();
        $puntos = array();
        foreach ($puntuacionesJuego1 as $puntuacion){        	
        	$nivel[] = $puntuacion->getNivel();
        	$puntos[] = $puntuacion->getPuntos();
        }
        
        $series = array(
		    array(
		        'name'  => 'Nivel',
		        'type'  => 'column',
		        'color' => '#4572A7',
		        'yAxis' => 1,
		        'data'  => $nivel,
		    ),
		    array(
		        'name'  => 'Puntos',
		        'type'  => 'spline',
		        'color' => '#AA4643',
		        'data'  => $puntos,
		    ),
		);
		$yData = array(
		    array(
		        'labels' => array(
		            'formatter' => new Expr('function () { return this.value + " " }'),
		            'style'     => array('color' => '#AA4643')
		        ),
		        'title' => array(
		            'text'  => 'puntos',
		            'style' => array('color' => '#AA4643')
		        ),
		        'opposite' => true,
		    ),
		    array(
		        'labels' => array(
		            'formatter' => new Expr('function () { return this.value + " " }'),
		            'style'     => array('color' => '#4572A7')
		        ),
		        'gridLineWidth' => 0,
		        'title' => array(
		            'text'  => 'nivel',
		            'style' => array('color' => '#4572A7')
		        ),
		    ),
		);
// 		$categories = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
		
		$ob = new Highchart();
		$ob->chart->renderTo('container'); // The #id of the div where to render the chart
		$ob->chart->type('column');
		$ob->title->text('Nivel frente a puntos');
// 		$ob->xAxis->categories($categories);
		$ob->yAxis($yData);
		$ob->legend->enabled(false);
		$formatter = new Expr('function () {
		                 var unit = {
		                     "nivel": " ",
		                     "Puntos": " "
		                 }[this.series.name];
		                 return this.x + ": <b>" + this.y + "</b> " + unit;
		             }');
		$ob->tooltip->formatter($formatter);
		$ob->series($series);
		
        return $this->render('::your_template.html.twig', array(
            'chart' => $ob
        ));
    }
}
