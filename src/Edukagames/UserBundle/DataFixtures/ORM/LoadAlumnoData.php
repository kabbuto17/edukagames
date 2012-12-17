<?php

namespace Edukagames\UserBundle\DataFixtures\ORM;

use Symfony\Component\Validator\Constraints\Date;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Edukagames\UserBundle\Entity\Alumno;

class LoadAlumnoData implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		
		for($i = 1; $i<51; $i++){
			$alumnoFixture = new Alumno();
			$alumnoFixture->setNombre("alumno".$i);
			$alumnoFixture->setApellidos("Apellidos".$i);
			$alumnoFixture->setCurso("1");
			$alumnoFixture->setDiagnostico("Diagnostico");
			$alumnoFixture->setFechaNacimiento(new \DateTime("now"));
			$alumnoFixture->setPassword("alumno".$i);
			$alumnoFixture->setSalt(md5($alumnoFixture->getNombre()));
			$alumnoFixture->setUserName("alumno".$i);
			$manager->persist($alumnoFixture);
		}
		$manager->flush();
	}
}
?>