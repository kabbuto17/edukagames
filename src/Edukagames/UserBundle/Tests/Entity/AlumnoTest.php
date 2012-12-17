<?php 

namespace Edukagames\UserBundle\Tests\Entity;

use Doctrine\Bundle\DoctrineBundle\Registry;

use Edukagames\UserBundle\Entity\Alumno;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AlumnoTest extends WebTestCase
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $em;
	
	/**
	 * {@inheritDoc}
	 */
	public function setUp()
	{
		static::$kernel = static::createKernel();
		static::$kernel->boot();
		$this->em = static::$kernel->getContainer()
		->get('doctrine')
		->getEntityManager()
		;
	}
	public function testIndex()
	{
		$alumno = new Alumno();
		$alumno->setApellidos("grillo");
		$alumno->setCurso("1");
		$alumno->setDiagnostico("tdh");
		$alumno->setFechaNacimiento(date("now"));
		$alumno->setNombre("pepito");
		$alumno->setPassword("pepitogrillo");
		$alumno->setSalt(md5($alumno->getNombre()));
		$alumno->setUserName("pegri");
		ldd($this->em);
		$this->$em->persist($alumno);
		$em->flush();
		
		$alumn = $this->getDotrine()->getEntityManager()->getRepository('UserBundle:Alumno')->findByNombre("pepito");
		$this->assertEquals("pepito", $alumn->getNombre());
	}
	
	protected function tearDown()
	{
		parent::tearDown();
		$this->em->close();
	}
	
}
?>