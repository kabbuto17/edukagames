<?php

namespace Edukagames\UserBundle\DataFixtures\ORM;

use Symfony\Component\Validator\Constraints\Date;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Edukagames\UserBundle\Entity\Alumnos;

class LoadUserData implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		
		for($i = 1; $i<51; $i++){
			$alumnoFixture = new Alumnos();
			$alumnoFixture->setNombre("alumno".$i);
			$alumnoFixture->setApellidos("Apellidos".$i);
			$alumnoFixture->setCurso("1");
			$alumnoFixture->setDiagnostico("Diagnostico");
			$alumnoFixture->setEdad($i);
			$alumnoFixture->setFechaNacimiento(new \DateTime("now"));
			$alumnoFixture->setPassword("alumno".$i);
			$alumnoFixture->setSalt("aleatorio");
			
			$manager->persist($alumnoFixture);
			$manager->flush();
		}
	}
}
?>