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

class LoadArchivoData implements FixtureInterface, ContainerAwareInterface {
	
	private $container;
	
	public function load(ObjectManager $manager) {
		
		$em = $this->container->get('doctrine')->getEntityManager()->getRepository('AdminBundle:Informe')->findAll();
		
		foreach ($em as $informe){
			
			for ($i = 0; $i < 3; $i++) {
				$archivoFixture = new Archivo();
				$archivoFixture->setFecha(new \DateTime('now'));
				$archivoFixture->setInforme($informe);
				$archivoFixture->setNombreArchivo('Archivo-'.$i.'.pdf');
				$archivoFixture->setSalt(md5(time()));
				
				$manager->persist($archivoFixture);
			}
			$manager->flush();
		}
	}
	public function setContainer(ContainerInterface $container = null) {
		$this->container = $container;
	}

}
?>