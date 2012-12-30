<?php
namespace Edukagames\AdminBundle\DataFixtures\ORM;

use Edukagames\AdminBundle\Entity\Archivo;

use Edukagames\AdminBundle\Entity\Informe;
use Edukagames\UserBundle\Entity;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Validator\Constraints\Date;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadInformeData implements FixtureInterface, ContainerAwareInterface {
	
	private $container;
	
	public function load(ObjectManager $manager) {
		
		$em = $this->container->get('doctrine')->getEntityManager()->getRepository('UserBundle:Alumno')->findAll();
		
		foreach ($em as $alumno){
			
			for ($i = 0; $i < 3; $i++) {
				$InformeFixture = new Informe();
				$InformeFixture->setFecha(new \DateTime('now'));
				$InformeFixture->setAlumno($alumno);
				$InformeFixture->setDescripcion("descripcion de prueba de no mas de 255 caracteres");
				$InformeFixture->setNombreInforme("Informe-".$i.".pdf");
				
				$manager->persist($InformeFixture);
			}
			$manager->flush();
		}
	}
	public function setContainer(ContainerInterface $container = null) {
		$this->container = $container;
	}

}
?>