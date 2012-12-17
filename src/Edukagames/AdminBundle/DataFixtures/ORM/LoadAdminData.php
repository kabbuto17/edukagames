<?php

namespace Edukagames\AdminBundle\DataFixtures\ORM;

use Symfony\Component\Validator\Constraints\Date;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Edukagames\AdminBundle\Entity\Profesor;

class LoadAdminData implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		
		for($i = 1; $i<51; $i++){
			$profesorFixture = new Profesor();
			$profesorFixture->setNombre("profesor".$i);
			$profesorFixture->setPassword("profesor".$i);
			$profesorFixture->setSalt(md5($profesorFixture->getNombre()));
			
			$manager->persist($alumnoFixture);
		}
		$manager->flush();
	}
}
?>