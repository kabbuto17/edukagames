<?php
namespace Edukagames\AdminBundle\DataFixtures\ORM;

use Edukagames\AdminBundle\Entity\Juego;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Validator\Constraints\Date;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadJuegoData implements FixtureInterface, ContainerAwareInterface {
	
	private $container;
	
	public function load(ObjectManager $manager) {
		
		for ($i = 1; $i <= 5; $i++) {
			for($j = 1; $j <= 5; $j++){
				for($k = 1; $k <= 5; $k++){
					$juegoFixture = new Juego();
					$juegoFixture->setNombre('Juego'.$i);
					$juegoFixture->setDescripcion('Descripcion del juego');
					$juegoFixture->setImagen('Defaultprofile.png');
					$juegoFixture->setXML('Juego'.$i.'.xml');
					$juegoFixture->setNivel('Nivel'.$j);
					$juegoFixture->setFase('Fase'.$k);
					$manager->persist($juegoFixture);
					
				}
			}
			$manager->flush();
		}
		
	}
	public function setContainer(ContainerInterface $container = null) {
		$this->container = $container;
	}

}
