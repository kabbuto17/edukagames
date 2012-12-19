<?php

namespace Edukagames\AdminBundle\DataFixtures\ORM;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Validator\Constraints\Date;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Edukagames\AdminBundle\Entity\Profesor;

class LoadAdminData implements FixtureInterface, ContainerAwareInterface {
	
	private $container;
	
	public function load(ObjectManager $manager) {

		for ($i = 1; $i < 51; $i++) {
			
			$profesorFixture = new Profesor();
			
			$pwd = 'profesor'.$i;
			$salt = md5(time());
			$encoder = $this->container->get('security.encoder_factory')->getEncoder($profesorFixture);
			
			$profesorFixture->setNombre("profesor" . $i);
			$profesorFixture->setPassword($encoder->encodePassword($pwd,$salt));
			$profesorFixture->setSalt($salt);
			
			$manager->persist($profesorFixture);
		}
		$manager->flush();
	}
	public function setContainer(ContainerInterface $container = null) {
		$this->container = $container;
	}

}
?>