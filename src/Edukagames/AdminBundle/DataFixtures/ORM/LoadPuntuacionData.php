<?php
namespace Edukagames\AdminBundle\DataFixtures\ORM;

use Symfony\Component\Validator\Constraints\Time;

use Edukagames\AdminBundle\Entity\Puntuacion;

use Doctrine\Bundle\DoctrineBundle\Registry;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Validator\Constraints\Date;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadPuntuacionData implements FixtureInterface, ContainerAwareInterface {
	
	private $container;
	
	public function load(ObjectManager $manager) {
		$dificultad = Array("facil","medio","dificil");
		$emJuego = $this->container->get('doctrine')->getEntityManager()->getRepository('AdminBundle:Juego')->findAll();
		$emAlumno = $this->container->get('doctrine')->getEntityManager()->getRepository('UserBundle:Alumno')->findAll();
		foreach ($emAlumno as $alumno){
			foreach ($emJuego as $juego) {
					$puntuacionFixture = new Puntuacion();
					$puntuacionFixture->setAlumno($alumno);
					$puntuacionFixture->setJuego($juego);
					$puntuacionFixture->setDificultad($dificultad[rand(0, 2)]);
					$puntuacionFixture->setAciertos(rand(0, 20));
					$puntuacionFixture->setFallos(rand(0, 20));
					$puntuacionFixture->setPuntos(rand(0, 100));
					$puntuacionFixture->setTiempo((microtime(true)+rand(5, 240)) - microtime(true)); //20.08 segundos.
					$puntuacionFixture->setFecha(new \DateTime('now'));
					
					$manager->persist($puntuacionFixture);
				
					
			}
			$manager->flush();
		}
	}
	public function setContainer(ContainerInterface $container = null) {
		$this->container = $container;
	}

}
