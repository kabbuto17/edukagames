<?php

namespace Edukagames\UserBundle\DataFixtures\ORM;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Validator\Constraints\Date;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Edukagames\UserBundle\Entity\Alumno;

class LoadAlumnoData implements FixtureInterface, ContainerAwareInterface {

	private $container;
	
	public function load(ObjectManager $manager) {

		for ($i = 1; $i < 51; $i++) {
			$alumnoFixture = new Alumno();

			$pwd = 'alumno' . $i;
			$salt = md5(time());
			$enconder = $this->container->get('security.encoder_factory')
					->getEncoder($alumnoFixture);

			$alumnoFixture->setNombre("alumno" . $i);
			$alumnoFixture->setApellidos("Apellidos" . $i);
			$alumnoFixture->setCurso("1");
			$alumnoFixture->setDiagnostico("Diagnostico");
			$alumnoFixture->setSalt($salt);
			$alumnoFixture->setFoto('defaultprofile.png');
			$alumnoFixture->setFechaNacimiento(new \DateTime("now"));

			$alumnoFixture->setPassword($enconder->encodePassword($pwd, $salt));

			$alumnoFixture->setUserName("alumno" . $i);
			$manager->persist($alumnoFixture);
		}
		$manager->flush();
	}
	public function setContainer(ContainerInterface $container = null) {
		$this->container = $container;

	}

}
?>